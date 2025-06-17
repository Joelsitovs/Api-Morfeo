<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function index(Request $request)
    {
        $user = $request->user();

        if ($user->hasRole('admin')) {
            return response()->json(Order::latest()->get());
        }

        return response()->json(
            Order::where('customer_email', $user->email)->latest()->get()
        );
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'session_id' => 'required|string',
            'customer_email' => 'required|email',
            'amount_total' => 'required|numeric',
            'currency' => 'required|string',
            'items' => 'required|array',
        ]);

        $order = Order::updateOrCreate(
            ['session_id' => $data['session_id']],
            [
                'customer_email' => $data['customer_email'],
                'amount_total' => $data['amount_total'],
                'currency' => $data['currency'],
                'items' => json_encode($data['items']),
            ]
        );

        return response()->json(['success' => true, 'order' => $order]);
    }
}
