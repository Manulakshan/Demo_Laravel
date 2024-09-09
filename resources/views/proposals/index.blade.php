<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proposal List</title>
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

        <h1 class="mb-4">Proposal List</h1>
        
        <div class="mb-3">
            <a href="{{ route('proposals.create') }}" class="btn btn-primary">Add New Proposal</a>
        </div>
        
        <table class="table table-bordered">
            <thead class="thead-light">
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Details</th>
                    <th>Status</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($proposals as $proposal)
                <tr>
                    <td>{{ $proposal->id }}</td>
                    <td>{{ $proposal->title }}</td>
                    <td>{{ $proposal->details }}</td>
                    <td>{{ $proposal->status }}</td>
                    <td>
                        <a href="{{ route('proposals.edit', ['proposal' => $proposal]) }}" class="btn btn-warning btn-sm">Edit</a>
                    </td>
                    <td>
                        <form method="post" action="{{ route('proposals.destroy', ['proposal' => $proposal]) }}">
                            @csrf
                            @method('delete')
                            <input type="submit" value="Delete" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this proposal?');">
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
