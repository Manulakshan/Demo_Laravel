<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Proposals</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Edit Proposal Details</h1>
        <form method="post" action="{{ route('proposals.update', ['proposal' => $proposal]) }}">
            @csrf
            @method('put')

            <div class="form-group">
                <label for="customer_id">Customer</label>
                <select id="customer_id" name="customer_id" class="form-control">
                    @foreach($customers as $customer)
                        <option value="{{ $customer->id }}" {{ $customer->id == $proposal->customer_id ? 'selected' : '' }}>{{ $customer->name }}</option>
                    @endforeach
                </select>       
            </div> 

            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" id="title" name="title" value="{{ $proposal->title }}" class="form-control" />
            </div>    

            <div class="form-group">
                <label for="details">Details</label>
                <textarea id="details" name="details" class="form-control">{{ $proposal->details }}</textarea>
            </div>  

            <div class="form-group">
                <label for="status">Status</label>
                <select id="status" name="status" class="form-control">
                    <option value="active" {{ $proposal->status == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="N/A" {{ $proposal->status == 'N/A' ? 'selected' : '' }}>N/A</option>
                </select>      
            </div>     

            <div class="form-group">
                <input type="submit" value="Update" class="btn btn-primary">
            </div>    
        </form>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
