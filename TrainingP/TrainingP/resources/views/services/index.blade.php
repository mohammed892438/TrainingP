<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Services List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h1 class="text-center mb-4">Available Services</h1>

    <a href="{{ route('services.create') }}" class="btn btn-success mb-3">Add New Service</a>

    <table class="table table-hover table-bordered">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Description</th>
                <th>Training Areas</th>
                <th>Client Type</th>
                <th>Client Level</th>
                <th>Application Method</th>
                <th>Hourly Wage</th>
                <th>Work Experience</th>
                <th>Added Value</th>
                <th>Notes</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($services as $service)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $service->title }}</td>
                    <td>{{ Str::limit($service->description, 50) }}</td>
                    <td>{{ is_array($service->training_areas) ? implode(', ', $service->training_areas) : $service->training_areas }}</td>

                    <td>{{ $service->client_type }}</td>
                    <td>{{ $service->client_level }}</td>
                    <td>{{ $service->application_method }}</td>
                    <td>${{ number_format($service->hourly_wage, 2) }}</td>
                    <td>{{ $service->workExperience?->title ?? 'غير محددة' }}</td>
                    <td>{{ Str::limit($service->added_value, 50) }}</td>
                    <td>{{ Str::limit($service->notes, 50) }}</td>
                    <td>
                        <a href="{{ route('services.edit', $service->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('services.destroy', $service->id) }}" method="POST" style="display: inline-block;">
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