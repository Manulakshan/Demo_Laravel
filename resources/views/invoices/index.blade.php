<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice List</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <h1 class="mb-4">Invoice List</h1>
        
        <div class="mb-3">
            <a href="{{ route('invoices.create') }}" class="btn btn-primary">Add New Invoice</a>
        </div>
        
        <table class="table table-bordered">
            <thead class="thead-light">
                <tr>
                    <th>ID</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Edit</th>
                    <th>Delete</th>
                    <th>Update Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($invoices as $invoice)
                <tr>
                    <td>{{ $invoice->id }}</td>
                    <td>{{ $invoice->amount }}</td>
                    <td>{{ $invoice->status }}</td>
                    <td>
                        <a href="{{ route('invoices.edit', ['invoice' => $invoice]) }}" class="btn btn-warning btn-sm">Edit</a>
                    </td>
                    <td>
                        <form method="post" action="{{ route('invoices.destroy', ['invoice' => $invoice]) }}" onsubmit="return confirm('Are you sure you want to delete this invoice?');">
                            @csrf
                            @method('delete')
                            <input type="submit" value="Delete" class="btn btn-danger btn-sm">
                        </form>
                    </td>
                    <td>
                        <form method="POST" action="{{ route('invoices.send', $invoice) }}">
                            @csrf
                            <input type="submit" value="Send Email" class="btn btn-info btn-sm">
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
