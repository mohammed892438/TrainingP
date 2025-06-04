<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complete Registration Form</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"> <!-- Adjust stylesheet as needed -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h2 class="text-center mb-4">Complete Registration Form</h2>
        <form action="{{ route('trainee.complete-register', $user->id) }}" method="POST">
            @csrf
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


            <!-- Name in English -->
            <div class="mb-3">
                <label for="name_en" class="form-label">Name (English):</label>
                <input type="text" class="form-control" id="name_en" name="name_en" value="{{ $user->name_en }}" required>
            </div>

            <!-- Name in Arabic -->
            <div class="mb-3">
                <label for="name_ar" class="form-label">Name (Arabic):</label>
                <input type="text" class="form-control text-end" id="name_ar" name="name_ar" value="{{ $user->name_ar }}" required>
            </div>

            <!-- Last Name in English -->
            <div class="mb-3">
                <label for="last_name_en" class="form-label">Last Name (English):</label>
                <input type="text" class="form-control" id="last_name_en" name="last_name_en" required>
            </div>

            <!-- Last Name in Arabic -->
            <div class="mb-3">
                <label for="last_name_ar" class="form-label">Last Name (Arabic):</label>
                <input type="text" class="form-control text-end" id="last_name_ar" name="last_name_ar" required>
            </div>

            <!-- Phone Number -->
            <div class="mb-3">
                <label for="phone_number" class="form-label">Phone Number:</label>
                <input type="tel" class="form-control" id="phone_number" name="phone_number" required>
            </div>

            <!-- Country -->
            <div class="mb-3">
                <label for="country" class="form-label">Country:</label>
                <select class="form-select" id="country" name="country_id">
                    @foreach ($countries as $country)
                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- City -->
            <div class="mb-3">
                <label for="city" class="form-label">City:</label>
                <input type="text" class="form-control" id="city" name="city" required>
            </div>

            <!-- Nationality (Multi-select) -->
            <div class="mb-3">
                <label for="nationality" class="form-label">الجنسية</label>
                <select class="form-select" id="nationality" name="nationality[]" multiple required>
                    @foreach($nationalities as $nationality)
                        <option value="{{ $nationality->id }}">{{ $nationality->name }}</option>
                    @endforeach
                </select>
                <small class="text-muted">يمكنك اختيار أكثر من جنسية بالضغط على زر CTRL (في الويندوز) أو CMD (في الماك) والنقر على الخيارات.</small>
            </div>

            <!-- Sex -->
            <div class="mb-3">
                <label for="sex" class="form-label">Sex:</label>
                <select class="form-select" id="sex" name="sex">
                    @foreach ($sexs as $sex)
                        <option value="{{ $sex->value }}">{{ $sex->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Work Fields (Multi-select) -->
            <div class="mb-3">
                <label for="work_fields" class="form-label">Work Fields:</label>
                <select class="form-select" id="work_fields" name="work_fields[]" multiple>
                    @foreach ($work_fields as $work_field)
                        <option value="{{ $work_field->id }}">{{ $work_field->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Education Level -->
            <div class="mb-3">
                <label for="education_levels" class="form-label">Education Level:</label>
                <select class="form-select" id="education_levels" name="education_levels_id">
                    @foreach ($educatuin_levels as $education_level)
                        <option value="{{ $education_level->id }}">{{ $education_level->name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary w-100">Submit</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>