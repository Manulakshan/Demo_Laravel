<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Webhook;
use App\Models\Invoice; 
use App\Models\Transaction;

class StripeWebhookController extends Controller
{
    public function handleWebhook(Request $request)
    {
        $webhookSecret = config('services.stripe.webhook_secret');
        $signature = $request->header('Stripe-Signature');

        try {
            $event = Webhook::constructEvent(
                $request->getContent(),
                $signature,
                $webhookSecret
            );
        } catch (\UnexpectedValueException $e) {
            // Invalid payload
            return response()->json(['error' => 'Invalid payload'], 400);
        } catch (\Stripe\Exception\SignatureVerificationException $e) {
            // Invalid signature
            return response()->json(['error' => 'Invalid signature'], 400);
        }

        // Process the event
        if ($event->type === 'checkout.session.completed') {
            $session = $event->data->object;

            // Retrieve the invoice ID from the session metadata
            $invoiceId = $session->metadata->invoice_id;

            // Find the corresponding invoice
            $invoice = Invoice::find($invoiceId);
            
            dd($invoice->customer_id); 

            if ($invoice) {
                // Update the invoice status
                $invoice->update(['status' => 'paid']);

              
            }
        }

        return response()->json(['message' => 'Webhook received successfully']);
    }
}
