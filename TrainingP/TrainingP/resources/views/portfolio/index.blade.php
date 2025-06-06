<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إدارة الأعمال</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2 class="mb-4 text-center">إدارة الأعمال (Portfolio)</h2>

    @if (session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-3 text-end">
        <a href="{{ route('portfolio.store.form') }}" class="btn btn-primary">إضافة عمل جديد</a>
    </div>

    @if($portfolios->isEmpty())
        <div class="alert alert-info text-center">لا توجد أعمال حالياً.</div>
    @else
        <div class="row">
            @foreach($portfolios as $portfolio)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        @if($portfolio->photo)
                        <img src="{{ asset('storage/' . $portfolio->photo) }}" alt="صورة العمل" class="card-img-top">
                        @endif
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $portfolio->title }}</h5>

                            @php
                                $isUrl = filter_var($portfolio->file, FILTER_VALIDATE_URL);
                            @endphp

                            @if($isUrl)
                                <a href="{{ $portfolio->file }}" target="_blank" class="btn btn-outline-primary btn-sm mt-auto">عرض الرابط</a>
                            @else
                                <a href="{{ asset('storage/' . $portfolio->file) }}" class="btn btn-outline-info btn-sm mt-auto" download>تحميل الملف</a>
                            @endif
                        </div>
                        <div class="card-footer d-flex justify-content-between">
                            <a href="{{ route('portfolio.update.form', $portfolio->id) }}" class="btn btn-warning btn-sm">تعديل</a>
                            <form action="{{ route('portfolio.delete', $portfolio->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من الحذف؟')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">حذف</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

</body>
</html>
