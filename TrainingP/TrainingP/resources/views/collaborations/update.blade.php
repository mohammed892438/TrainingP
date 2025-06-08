<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>تعديل التعاون</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h1 class="mb-4 text-center">تعديل التعاون</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('collaborations.update', $collaboration->id) }}" method="POST">
        @csrf
        @method('PUT')

        <input type="hidden" name="organizations_id" value="{{ Auth::user()->organizations_id }}">

        <div class="mb-3">
            <label for="coporations_id" class="form-label">الشركة</label>
            <select name="coporations_id" class="form-select">
                @foreach ($corporations as $corporation)
                <option value="{{ $corporation->id }}" {{ $collaboration->coporations_id == $corporation->id ? 'selected' : '' }}>
                    {{ $corporation->name }}
                </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">تحديث</button>
        <a href="{{ route('collaborations.index') }}" class="btn btn-secondary">إلغاء</a>
    </form>
</div>

</body>
</html>