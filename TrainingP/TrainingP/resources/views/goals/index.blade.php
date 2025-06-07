<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>قائمة الأهداف</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4">قائمة الأهداف</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('goals.create') }}" class="btn btn-primary mb-3">إضافة هدف جديد</a>

    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>اسم الهدف</th>
                <th>التحكم</th>
            </tr>
        </thead>
        <tbody>
            @forelse($goals as $goal)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $goal->name }}</td>
                    <td>
                        <a href="{{ route('goals.edit', $goal->id) }}" class="btn btn-warning btn-sm">تعديل</a>
                        <form action="{{ route('goals.destroy', $goal->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('هل أنت متأكد من الحذف؟')">حذف</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center">لا يوجد أهداف بعد.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
</body>
</html>
