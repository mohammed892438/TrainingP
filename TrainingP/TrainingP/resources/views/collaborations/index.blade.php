<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>قائمة التعاون</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h1 class="mb-4 text-center">قائمة التعاون</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('collaborations.create') }}" class="btn btn-primary mb-3">إضافة تعاون جديد</a>

    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>المؤسسة</th>
                <th>الشركة</th>
                <th>التحكم</th>
            </tr>
        </thead>
        <tbody>
            @forelse($collaborations as $collaboration)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ Auth::user()->name  }}</td>
                    <td>{{ optional($collaboration->coporation)->name }}</td>
                    <td>
                        <a href="{{ route('collaborations.edit', $collaboration->id) }}" class="btn btn-warning btn-sm">تعديل</a>
                        <form action="{{ route('collaborations.destroy', $collaboration->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('هل أنت متأكد من الحذف؟')">حذف</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">لا يوجد تعاون بعد.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

</body>
</html>