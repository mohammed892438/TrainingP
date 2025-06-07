<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Service</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-warning text-white">
            <h4>Edit Service</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('services.update', $service->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="title" class="form-label">Service Title</label>
                    <input type="text" name="title" class="form-control" id="title" value="{{ old('title', $service->title) }}" required>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" class="form-control" id="description" rows="4" required>{{ old('description', $service->description) }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="training_areas">Training Areas (comma-separated)</label>
                    <input type="text" name="training_areas" class="form-control" id="training_areas">
                </div>

                <div class="mb-3">
                    <label for="client_type" class="form-label">Client Type</label>
                    <input type="text" name="client_type" class="form-control" id="client_type" value="{{ old('client_type', $service->client_type) }}" required>
                </div>

                <div class="mb-3">
                    <label for="client_level" class="form-label">Client Level</label>
                    <input type="text" name="client_level" class="form-control" id="client_level" value="{{ old('client_level', $service->client_level) }}" required>
                </div>

                <div class="mb-3">
                    <label for="application_method" class="form-label">Application Method</label>
                    <input type="text" name="application_method" class="form-control" id="application_method" value="{{ old('application_method', $service->application_method) }}" required>
                </div>

                <div class="mb-3">
                    <label for="hourly_wage" class="form-label">Hourly Wage ($)</label>
                    <input type="number" step="0.01" name="hourly_wage" class="form-control" id="hourly_wage" value="{{ old('hourly_wage', $service->hourly_wage) }}" required>
                </div>

                <div class="mb-3">
                    <label for="work_experience_id" class="form-label">Select Work Experience</label>
                    <select name="work_experience_id" class="form-select" id="work_experience_id" required>
                        <option value="">Choose Work Experience</option>
                        @foreach($workExperience as $experience)
                            <option value="{{ $experience->id }}">{{ $experience->title }}</option>
                        @endforeach
                    </select>
                </div>


                <div class="mb-3">
                    <label for="added_value" class="form-label">Added Value (Optional)</label>
                    <textarea name="added_value" class="form-control" id="added_value" rows="2">{{ old('added_value', $service->added_value) }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="notes" class="form-label">Notes (Optional)</label>
                    <textarea name="notes" class="form-control" id="notes" rows="3">{{ old('notes', $service->notes) }}</textarea>
                </div>


                <button type="submit" class="btn btn-success">Update Service</button>
                <a href="{{ route('services.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
