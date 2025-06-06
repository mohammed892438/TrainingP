<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>الأعمال (Portfolio)</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4 text-center">الأعمال (Portfolio)</h2>

    @if (session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger text-center">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="mb-3 text-end">
        <a href="{{ route('portfolio.store') }}" class="btn btn-primary">إضافة عمل جديد</a>
    </div>

    <table class="table table-bordered text-center align-middle">
        <thead class="table-dark">
            <tr>
                <th>العنوان</th>
                <th>الصورة</th>
                <th>الملف</th>
                <th>الخيارات</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($portfolios as $portfolio)
                <tr>
                    <td>{{ $portfolio->title }}</td>
                    <td>
                        @if ($portfolio->photo)
                            <img src="{{ asset('storage/' . $portfolio->photo) }}" alt="صورة العمل" width="80">
                        @else
                            <span class="text-muted">لا توجد صورة</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ asset('storage/' . $portfolio->file) }}" target="_blank" class="btn btn-sm btn-outline-info">عرض / تحميل</a>
                    </td>
                    <td>
                        <a href="{{ route('portfolio.update', $portfolio->id) }}" class="btn btn-sm btn-warning">تعديل</a>
                        <form action="{{ route('portfolio.delete', $portfolio->id) }}" method="POST" class="d-inline" onsubmit="return confirm('هل أنت متأكد من الحذف؟')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">حذف</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-muted">لا توجد أعمال حالياً.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
</body>
</html>
