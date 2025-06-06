<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Education Records</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Education Records</h1>

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

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Specialization</th>
                    <th>University</th>
                    <th>Graduation Year</th>
                    <th>Education Level</th>
                    <th>Language</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($educations as $education)
                    <tr>
                        <td>{{ $education->specialization }}</td>
                        <td>{{ $education->university }}</td>
                        <td>{{ $education->graduation_year }}</td>
                        <td>{{ $education->educationLevel->name }}</td>
                        <td>{{ $education->language->name }}</td>
                        <td>
                            <a href="{{ route('education.update.form', $education->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('education.delete', $education->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <a href="{{ route('education.store.form') }}" class="btn btn-primary">Add New Education</a>
    </div>
</body>
</html>