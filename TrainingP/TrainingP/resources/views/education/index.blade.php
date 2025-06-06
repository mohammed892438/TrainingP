<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>السجلات التعليمية</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4 text-center">السجلات التعليمية</h2>

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
        <a href="{{ route('education.store.form') }}" class="btn btn-primary">إضافة تعليم جديد</a>
    </div>

    <table class="table table-bordered text-center align-middle">
        <thead class="table-dark">
            <tr>
                <th>التخصص</th>
                <th>الجامعة</th>
                <th>سنة التخرج</th>
                <th>المستوى التعليمي</th>
                <th>اللغات</th>
                <th>الخيارات</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($educations as $education)
                <tr>
                    <td>{{ $education->specialization }}</td>
                    <td>{{ $education->university }}</td>
                    <td>{{ $education->graduation_year }}</td>
                    <td>{{ optional($education->educationLevel)->name ?? '-' }}</td>
                    <td>
                        @if (!empty($education->language_names))
                            <ul class="list-unstyled mb-0">
                                @foreach ($education->language_names as $lang)
                                    <li>{{ $lang }}</li>
                                @endforeach
                            </ul>
                        @else
                            <span class="text-muted">لا توجد لغات</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('education.update.form', $education->id) }}" class="btn btn-sm btn-warning">تعديل</a>
                        <form action="{{ route('education.delete', $education->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('هل أنت متأكد من الحذف؟')">حذف</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-muted">لا توجد سجلات تعليمية.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
</body>
</html>
