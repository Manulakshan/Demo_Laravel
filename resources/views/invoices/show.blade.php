<!-- resources/views/invoices/show.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Details</title>
    <!-- Include Bootstrap or other CSS here -->
</head>
<body>
    <div class="container mt-5">
        <h1>Invoice Details</h1>
        <p><strong>Invoice ID:</strong> {{ $invoice->id }}</p>
        <p><strong>Amount:</strong> {{ $invoice->amount }}</p>
        <p><strong>Status:</strong> {{ $invoice->status }}</p>
        <p><strong>Customer ID:</strong> {{ $invoice->customer_id }}</p>
        <!-- Add other invoice details as necessary -->
        
        <a href="{{ route('invoices.index') }}" class="btn btn-primary">Back to Invoice List</a>
    </div>
</body>
</html>
