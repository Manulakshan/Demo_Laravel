<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Payment</title>
    <!-- Bootstrap CSS for styling -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            color: #495057;
        }
        .invoice-container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .invoice-header {
            margin-bottom: 20px;
        }
        .invoice-header h1 {
            font-size: 24px;
            color: #343a40;
        }
        .invoice-details p {
            font-size: 16px;
            margin: 10px 0;
        }
        .btn-pay {
            display: inline-block;
            padding: 12px 24px;
            font-size: 16px;
            color: #ffffff;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            text-align: center;
            text-decoration: none;
            transition: background-color 0.3s;
        }
        .btn-pay:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="invoice-container">
        <div class="invoice-header text-center">
            <h1>Invoice for Your Purchase</h1>
        </div>
        <div class="invoice-details">
            <p><strong>Invoice ID:</strong> {{ $invoice->id }}</p>
            <p><strong>Amount Due:</strong> ${{ number_format($invoice->amount, 2) }}</p>
        </div>
        <div class="text-center">
            <a href="{{ route('invoices.pay', ['invoice' => $invoice->id]) }}" class="btn-pay">Pay Now</a>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
