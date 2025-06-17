<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Stripe\PaymentIntent;
use Stripe\Stripe;

class WebhookController extends Controller
{
    public function handle(Request $request)
    {
        $payload = $request->getContent();
        $sigHeader = $request->header('Stripe-Signature');
        $secret = env('STRIPE_WEBHOOK_SECRET');

        try {
            $event = \Stripe\Webhook::constructEvent(
                $payload, $sigHeader, $secret
            );
        } catch (\Exception $e) {
            Log::error('Webhook error: ' . $e->getMessage());
            return response()->json(['error' => 'Invalid signature'], 400);
        }

        if ($event->type === 'checkout.session.completed') {
            $session = $event->data->object;
            Log::info('Stripe session completed', (array) $session);

            try {
                Stripe::setApiKey(env('STRIPE_SECRET'));
                $intent = PaymentIntent::retrieve($session->payment_intent);
                $metadataItems = json_decode($intent->metadata->items ?? '[]', true);

                Order::updateOrCreate(
                    ['session_id' => $session->id],
                    [
                        'customer_email' => $session->customer_details->email ?? 'no-email@stripe.com',
                        'amount_total' => $session->amount_total / 100,
                        'currency' => $session->currency,
                        'items' => json_encode($metadataItems),
                    ]
                );

                Log::info('Orden guardada correctamente');
            } catch (\Exception $e) {
                Log::error('Error al recuperar el PaymentIntent: ' . $e->getMessage());
                return response()->json(['error' => 'Error al guardar orden'], 500);
            }
        }

        return response()->json(['status' => 'success']);
    }
}
