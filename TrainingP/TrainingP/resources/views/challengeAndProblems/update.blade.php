<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>تعديل هدف</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4">تعديل تحدي</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('challengeAndProblems.update', $challengeAndProblems->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">اسم تحدي</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $challengeAndProblems->name) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">تحديث</button>
        <a href="{{ route('challengeAndProblems.index') }}" class="btn btn-secondary">رجوع</a>
    </form>
</div>
</body>
</html>
