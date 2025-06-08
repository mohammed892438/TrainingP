
<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>قائمة الالتزامات</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h1 class="mb-4 text-center">قائمة الالتزامات</h1>

        @if(session('success'))
            <div class="alert alert-success text-center">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger text-center">
                {{ $errors->first() }}
            </div>
        @endif

        <div class="mb-3 text-end">
            <a href="{{ route('commitments.create') }}" class="btn btn-primary">إضافة التزام جديد</a>
        </div>

        <table class="table table-bordered text-center">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>اسم الالتزام</th>
                    <th>جهة الالتزام</th>
                    <th>تاريخ الإضافة</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                @forelse($commitments as $commitment)
                    <tr>
                        <td>{{ $commitment->id }}</td>
                        <td>{{ $commitment->name }}</td>
                        <td>{{ $commitment->committed_to }}</td>
                        <td>{{ $commitment->created_at->format('Y-m-d') }}</td>
                        <td>
                            <a href="{{ route('commitments.edit', $commitment->id) }}" class="btn btn-warning btn-sm">تعديل</a>
                            <form action="{{ route('commitments.destroy', $commitment->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('هل أنت متأكد من الحذف؟')">حذف</button>
                        </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">لا توجد بيانات.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>

</html>
