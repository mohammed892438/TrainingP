<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Training Experiences</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Your Training Experiences</h1>

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

        <table class="table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Country</th>
                    <th>Authority</th>
                    <th>Engagement Type</th>
                    <th>Trainees Number</th>
                    <th>Trainees Type</th>
                    <th>Hours Number</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($trainingExperiences as $experience)
                    <tr>
                        <td>{{ $experience->title_id ? $experience->title->name : 'N/A' }}</td>
                        <td>{{ $experience->country_id ? $experience->country->name : 'N/A' }}</td>
                        <td>{{ $experience->authority }}</td>
                        <td>{{ $experience->engagement_type }}</td>
                        <td>{{ $experience->trainees_number }}</td>
                        <td>{{ $experience->trainees_type }}</td>
                        <td>{{ $experience->hours_number }}</td>
                        <td>{{ $experience->description }}</td>
                        <td>
                            <a href="{{ route('trainingExperience.edit', $experience->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('trainingExperience.destroy', $experience->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <a href="{{ route('trainingExperience.create') }}" class="btn btn-primary">Add New Experience</a>
    </div>
</body>
</html>
