<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Customer Details</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Edit Customer Details</h1>
        <form method="post" action="{{ route('customers.update', ['customer' => $customer]) }}">
            @csrf
            @method('put')

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" class="form-control" placeholder="Name" value="{{ $customer->name }}" />
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" class="form-control" placeholder="Email" value="{{ $customer->email }}" />
            </div>

            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" id="address" name="address" class="form-control" placeholder="Address" value="{{ $customer->address }}" />
            </div>

            <div class="form-group">
                <label for="status">Status</label>
                <select id="status" name="status" class="form-control">
                    <option value="active" {{ $customer->status == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="N/A" {{ $customer->status == 'N/A' ? 'selected' : '' }}>N/A</option>
                </select>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
