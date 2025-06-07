<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Volunteerings</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h1 class="text-center mb-4">Volunteer Opportunities</h1>

    <a href="{{ route('volunteerings.create') }}" class="btn btn-success mb-3">Add Volunteering</a>

    <table class="table table-hover table-bordered">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Type</th>
                <th>Monthly Hours</th>
                <th>Training Titles</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($volunteerings as $volunteering)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $volunteering->type }}</td>
                    <td>{{ $volunteering->mounthly_hours }}</td>
                    <td>
                        <ul>
                            @foreach($volunteering->training_titles as $title)
                                <li>{{ $title }}</li>
                            @endforeach
                        </ul>
                    </td>
                    <td>
                        <a href="{{ route('volunteerings.edit', $volunteering->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('volunteerings.destroy', $volunteering->id) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>