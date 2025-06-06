<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Store Training Experience</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Store Training Experience</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('trainingExperience.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="title_id" class="form-label">Title</label>
                <select class="form-select" id="title_id" name="title_id" required>
                    <option value="">Select Title</option>
                    @foreach ($providedServices as $service)
                        <option value="{{ $service->id }}">{{ $service->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
            </div>


            <div class="mb-3">
                <label for="country_id" class="form-label">Country</label>
                <select class="form-select" id="country_id" name="country_id" required>
                    <option value="">Select Country</option>
                    @foreach ($countries as $country)
                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="authority" class="form-label">Authority</label>
                <input type="text" class="form-control" id="authority" name="authority" required>
            </div>

            <div class="mb-3">
                <label for="engagement_type" class="form-label">Engagement Type</label>
                <input type="text" class="form-control" id="engagement_type" name="engagement_type" required>
            </div>

            <div class="mb-3">
                <label for="trainees_number" class="form-label">Number of Trainees</label>
                <input type="number" class="form-control" id="trainees_number" name="trainees_number" min="1" required>
            </div>

            <div class="mb-3">
                <label for="trainees_type" class="form-label">Type of Trainees</label>
                <input type="text" class="form-control" id="trainees_type" name="trainees_type" required>
            </div>

            <div class="mb-3">
                <label for="hours_number" class="form-label">Number of Hours</label>
                <input type="number" class="form-control" id="hours_number" name="hours_number" min="1" required>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>
</html>