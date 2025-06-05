<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Training Experience</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Update Training Experience</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('training_experience.update', $trainingExperience->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="title_id" class="form-label">Title</label>
                <select class="form-select" id="title_id" name="title_id">
                    <option value="">Select Title (Optional)</option>
                    @foreach ($providedServices as $service)
                        <option value="{{ $service->id }}" {{ $trainingExperience->title_id == $service->id ? 'selected' : '' }}>
                            {{ $service->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="country_id" class="form-label">Country</label>
                <select class="form-select" id="country_id" name="country_id">
                    <option value="">Select Country (Optional)</option>
                    @foreach ($countries as $country)
                        <option value="{{ $country->id }}" {{ $trainingExperience->country_id == $country->id ? 'selected' : '' }}>
                            {{ $country->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="authority" class="form-label">Authority</label>
                <input type="text" class="form-control" id="authority" name="authority" value="{{ old('authority', $trainingExperience->authority) }}">
            </div>

            <div class="mb-3">
                <label for="engagement_type" class="form-label">Engagement Type</label>
                <input type="text" class="form-control" id="engagement_type" name="engagement_type" value="{{ old('engagement_type', $trainingExperience->engagement_type) }}">
            </div>

            <div class="mb-3">
                <label for="trainees_number" class="form-label">Number of Trainees</label>
                <input type="number" class="form-control" id="trainees_number" name="trainees_number" min="1" value="{{ old('trainees_number', $trainingExperience->trainees_number) }}">
            </div>

            <div class="mb-3">
                <label for="trainees_type" class="form-label">Type of Trainees</label>
                <input type="text" class="form-control" id="trainees_type" name="trainees_type" value="{{ old('trainees_type', $trainingExperience->trainees_type) }}">
            </div>

            <div class="mb-3">
                <label for="hours_number" class="form-label">Number of Hours</label>
                <input type="number" class="form-control" id="hours_number" name="hours_number" min="1" value="{{ old('hours_number', $trainingExperience->hours_number) }}">
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</body>
</html>