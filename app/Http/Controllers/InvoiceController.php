<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Customer; 
use App\Models\Transaction; 

use Illuminate\Support\Facades\Mail;
use App\Mail\InvoiceMail;  // Ensure this line is correct
use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession;
use Stripe\Webhook;


use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index(){

        $invoices = Invoice ::all();
        return view('invoices.index', ['invoices' => $invoices]);
    }

    public function create()
{
    $customers = Customer::all();
    return view('invoices.create', compact('customers'));
}

public function store(Request $request)
{
    $request->validate([
        'customer_id' => 'required|exists:customers,id',
        'amount' => 'required|numeric',
        'status' => 'required|in:pending,paid',
    ]);

    Invoice::create($request->all());

    return redirect()->route('invoices.index')->with('success', 'Invoice created successfully.');
}

public function edit(Invoice $invoice)
{
    $customers = Customer::all();
    return view('invoices.edit', compact('invoice', 'customers'));
}

public function update(Request $request, Invoice $invoice)
{
    $request->validate([
        'customer_id' => 'required|exists:customers,id',
        'amount' => 'required|numeric',
        'status' => 'required|in:pending,paid',
    ]);

    $invoice->update($request->all());

    return redirect()->route('invoices.index')->with('success', 'Invoice updated successfully.');
}

public function destroy(Invoice $invoice)
{
    $invoice->delete();

    return redirect()->route('invoices.index')->with('success', 'Invoice deleted successfully.');
}

 // Send email
public function sendEmail(Invoice $invoice)
{
   
    Mail::to('recipient@example.com')->send(new InvoiceMail($invoice));

    return redirect()->route('invoices.index')->with('success', 'Invoice email sent successfully.');
}

public function pay(Invoice $invoice)
{
    // Set up Stripe
    Stripe::setApiKey(config('services.stripe.secret'));

    // Create a Stripe Checkout Session
    $session = StripeSession::create([
        'payment_method_types' => ['card'],
        'line_items' => [
            [
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => 'Invoice #' . $invoice->id,
                    ],
                    'unit_amount' => $invoice->amount * 100, // Amount in cents
                ],
                'quantity' => 1,
            ],
        ],
        'mode' => 'payment',
        'success_url' => route('invoices.success', ['invoice' => $invoice->id]),
        'cancel_url' => route('invoices.cancel', ['invoice' => $invoice->id]),
        'metadata' => [ // Add metadata to store additional information
            'invoice_id' => $invoice->id // This allows you to track which invoice the payment is for
        ]
    ]);

    return redirect($session->url);
}

public function show(Invoice $invoice)
    {
        // Return a view to display the specific invoice details
        return view('invoices.show', compact('invoice'));
    }

    public function paymentSuccess(Invoice $invoice)
    {
        // Update invoice status
        $invoice->update(['status' => 'paid']);
    
        
        
        return redirect()->route('invoices.index')->with('success', 'Payment completed successfully.');
    }
    

    // Handle payment cancellation
    public function paymentCancel(Invoice $invoice)
    {
        return redirect()->route('invoices.index')->with('error', 'Payment was canceled.');
    }



}


