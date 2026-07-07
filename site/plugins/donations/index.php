<?php

require_once __DIR__ . '/../../../vendor/autoload.php';

use Kirby\Cms\App as Kirby;
use Kirby\Http\Response;

Kirby::plugin('yoursite/donations', [
    'routes' => [
        [
            'pattern' => 'donate/create-session',
            'method'  => 'POST',
            'action'  => function () {
                \Stripe\Stripe::setApiKey(option('stripe.secretKey'));

                $amount = (int) get('amount');
                if ($amount < 100) {
                    return Response::json(['error' => 'Invalid amount'], 400);
                }

                $session = \Stripe\Checkout\Session::create([
                    'payment_method_types' => ['card'],
                    'line_items' => [[
                        'price_data' => [
                            'currency' => 'eur',
                            'product_data' => ['name' => 'Donazione a Fondazione Maitreya'],
                            'unit_amount' => $amount,
                        ],
                        'quantity' => 1,
                    ]],
                    'mode' => 'payment',
                    'success_url' => url('donazione-grazie') . '?session_id={CHECKOUT_SESSION_ID}',
                    'cancel_url' => url('donazione'),
                ]);

                return Response::json(['url' => $session->url]);
            }
        ],
        [
            'pattern' => 'stripe-webhook',
            'method'  => 'POST',
            'action'  => function () {
                \Stripe\Stripe::setApiKey(option('stripe.secretKey'));

                $payload = file_get_contents('php://input');
                $sigHeader = $_SERVER['HTTP_STRIPE_SIGNATURE'] ?? '';
                $endpointSecret = option('stripe.webhookSecret');

                try {
                    $event = \Stripe\Webhook::constructEvent($payload, $sigHeader, $endpointSecret);
                } catch (\Exception $e) {
                    return Response::json(['error' => 'Invalid signature'], 400);
                }

                if ($event->type === 'checkout.session.completed') {
                    $session = $event->data->object;
                    $amount = $session->amount_total;
                    recordDonation($amount);
                }

                return Response::json(['received' => true]);
            }
        ]
    ]
]);

function recordDonation(int $amountCents): void
{
    $path = kirby()->root('site') . '/data/donations.json';

    $data = ['total_cents' => 0, 'donor_count' => 0];

    if (file_exists($path)) {
        $decoded = json_decode(file_get_contents($path), true);
        if (is_array($decoded)) {
            $data['total_cents'] = $decoded['total_cents'] ?? 0;
            $data['donor_count'] = $decoded['donor_count'] ?? 0;
        }
    }

    $data['total_cents'] += $amountCents;
    $data['donor_count'] += 1;

    file_put_contents($path, json_encode($data));
}