<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Stripe\Stripe;
use Illuminate\Support\Facades\Auth;

class StripeWebhookController extends Controller
{
    public function handleWebhook(Request $request)
    {
        Log::error('Webhook received', ['payload' => $request->all()]);

        Stripe::setApiKey(config('services.stripe.secret'));
        $endpoint_secret = config('services.stripe.webhook_secret');

        $payload = @file_get_contents('php://input');
        $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];

        try {
            $event = \Stripe\Webhook::constructEvent(
                $payload,
                $sig_header,
                $endpoint_secret
            );
            Log::emergency('Webhook event constructed successfully', ['type' => $event->type]);
        } catch (\UnexpectedValueException $e) {
            Log::emergency('Invalid payload', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Invalid payload'], 400);
        } catch (\Stripe\Exception\SignatureVerificationException $e) {
            Log::emergency('Invalid signature', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Invalid signature'], 400);
        }

        if ($event->type === 'checkout.session.completed') {
            return $this->handleCheckoutSessionCompleted($event);
        }

        return response()->json(['success' => true]);
    }

    private function handleCheckoutSessionCompleted($event)
    {
        Log::error('Processing checkout.session.completed');
        $session = $event->data->object;
        $metadata = $session->metadata;

        try {
            $order = Order::create([
                'user_id' => $metadata->user_id,
                'order_date' => now(),
                'address' => $metadata->shipping_address,
                'phone' => $metadata->phone,
                'status' => 'paid'
            ]);
            Log::emergency('Order created', ['order_id' => $order->id]);

            $cart = Cart::with(['cartItems.product'])->where('user_id', $metadata->user_id)->first();

            if ($cart) {
                foreach ($cart->cartItems as $item) {
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $item->product_id,
                        'quantity' => $item->quantity,
                        'price' => $item->product->price
                    ]);

                    $product = $item->product;
                    $product->quantity = max(0, $product->quantity - $item->quantity);
                    $product->save();
                }
                Log::error('Order items created and product quantities updated', ['order_id' => $order->id]);

                $cart->cartItems()->delete();
                $cart->delete();
                Log::emergency('Cart deleted');
            }

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            Log::emergency('Error processing webhook', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['error' => 'Internal server error'], 500);
        }
    }
}
