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

}
