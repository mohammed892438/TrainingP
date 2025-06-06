<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إضافة عمل جديد</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4 text-center">إضافة عمل جديد</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('portfolio.store') }}" method="POST" enctype="multipart/form-data" class="border p-4 rounded shadow-sm">
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label">عنوان العمل</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
        </div>

        <div class="mb-3">
            <label for="photo" class="form-label">صورة العمل (اختياري)</label>
            <input type="file" name="photo" id="photo" class="form-control">
        </div>

        <div class="mb-3">
            <label for="file" class="form-label">الملف أو الرابط</label>
            <input type="file" name="file" id="file" class="form-control mb-2">
            <input type="url" name="file" id="file_link" class="form-control" placeholder="أو أدخل رابط خارجي">
        </div>


        <div class="text-end">
            <button type="submit" class="btn btn-success">حفظ</button>
            <a href="{{ route('portfolio.index') }}" class="btn btn-secondary">رجوع</a>
        </div>
    </form>
</div>
</body>
</html>
