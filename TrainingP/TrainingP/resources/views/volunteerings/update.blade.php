<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Volunteering</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-warning text-white">
            <h4>Edit Volunteering Opportunity</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('volunteerings.update', $volunteering->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="type" class="form-label">Select Service Type</label>
                    <select name="type" class="form-select" id="type" required>
                        <option value="">Choose a Service</option>
                        @foreach($providedServices as $service)
                            <option value="{{ $service->id }}" {{ old('type', $volunteering->type) == $service->id ? 'selected' : '' }}>
                                {{ $service->name }}
                            </option>
                        @endforeach
                    </select>
                </div>


                <div class="mb-3">
                    <label for="mounthly_hours" class="form-label">Monthly Hours</label>
                    <input type="number" name="mounthly_hours" class="form-control" id="mounthly_hours" value="{{ old('mounthly_hours', $volunteering->mounthly_hours) }}" required>
                </div>

                <div class="mb-3">
                    <label for="training_titles">Training Areas (comma-separated)</label>
                    <input type="text" name="training_titles" class="form-control" id="training_titles">
                </div>

                <button type="submit" class="btn btn-success">Update</button>
                <a href="{{ route('volunteerings.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>