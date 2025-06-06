<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Education</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Add Education</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('education.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="specialization" class="form-label">Specialization</label>
                <input type="text" class="form-control" id="specialization" name="specialization" required>
            </div>

            <div class="mb-3">
                <label for="university" class="form-label">University</label>
                <input type="text" class="form-control" id="university" name="university" required>
            </div>

            <div class="mb-3">
                <label for="graduation_year" class="form-label">Graduation Year</label>
                <input type="date" class="form-control" id="graduation_year" name="graduation_year" required>
            </div>

            <div class="mb-3">
                <label for="education_levels_id" class="form-label">Education Level</label>
                <select class="form-select" id="education_levels_id" name="education_levels_id" required>
                    <option value="">Select Education Level</option>
                    @foreach ($educationlevels as $level)
                        <option value="{{ $level->id }}">{{ $level->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6">
                <label class="form-label">اللغات</label>
                <select class="form-select" name="languages[]" multiple required>
                    @foreach($languages as $lang)
                        <option value="{{ $lang->id }}">{{ $lang->name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>
</html>