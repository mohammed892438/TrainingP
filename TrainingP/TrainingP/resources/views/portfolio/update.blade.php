<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تعديل العمل</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4 text-center">تعديل العمل</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('portfolio.update', $portfolio->id) }}" method="POST" enctype="multipart/form-data" class="border p-4 rounded shadow-sm">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">عنوان العمل</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $portfolio->title) }}" required>
        </div>

        <div class="mb-3">
            <label for="photo" class="form-label">صورة العمل الحالية</label><br>
            @if($portfolio->photo)
                <img src="{{ asset('storage/' . $portfolio->photo) }}" alt="صورة العمل" width="120" class="mb-2 d-block">
            @else
                <span class="text-muted">لا توجد صورة حالياً</span>
            @endif
            <input type="file" name="photo" id="photo" class="form-control mt-2">
        </div>

        <div class="mb-3">
            <label for="file" class="form-label">الملف الحالي أو الرابط</label><br>
            @php
                $isUrl = filter_var($portfolio->file, FILTER_VALIDATE_URL);
            @endphp

            @if($isUrl)
                <a href="{{ $portfolio->file }}" target="_blank" class="d-block text-primary mb-2">عرض الرابط الحالي</a>
            @else
                <a href="{{ asset('storage/' . $portfolio->file) }}" target="_blank" class="d-block text-info mb-2">تحميل الملف الحالي</a>
            @endif

            <input type="file" name="file" id="file" class="form-control mb-2">
            <input type="url" name="file" id="file_link" class="form-control" placeholder="أو أدخل رابط خارجي">
        </div>

        <div class="text-end">
            <button type="submit" class="btn btn-success">تحديث</button>
            <a href="{{ route('portfolio.index') }}" class="btn btn-secondary">رجوع</a>
        </div>
    </form>
</div>
</body>
</html>
