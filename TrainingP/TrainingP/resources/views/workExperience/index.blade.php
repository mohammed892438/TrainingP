<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Work Experiences</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

    <div class="container mt-5">
        <h1>Your Work Experiences</h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <a href="{{ route('workExperience.create') }}" class="btn btn-primary mb-3">Add New Experience</a>

        <table class="table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Authority</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Country</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($workExperiences as $experience)
                    <tr>
                        <td>{{ $experience->title }}</td>
                        <td>{{ $experience->the_authority }}</td>
                        <td>{{ $experience->start_date }}</td>
                        <td>{{ $experience->end_date ?? 'N/A' }}</td>
                        <td>{{ $experience->country->name ?? 'N/A' }}</td>
                        <td>
                            <a href="{{ route('workExperience.edit', $experience->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('workExperience.destroy', $experience->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
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