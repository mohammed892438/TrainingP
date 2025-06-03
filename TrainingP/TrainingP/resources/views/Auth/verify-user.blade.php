<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>تأكيد البريد الإلكتروني</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white text-center">
                    <h4 class="mb-0">تأكيد البريد الإلكتروني</h4>
                </div>
                <div class="card-body text-center">

                    @isset($user)
                        <p class="fw-bold">البريد الإلكتروني الخاص بك:</p>
                        <p class="fs-5">{{ $user->email }}</p>

                        <p class="text-muted">
                            لقد تم إرسال رابط التحقق إلى بريدك الإلكتروني. يرجى التحقق من صندوق الوارد الخاص بك.
                        </p>

                        <form method="POST" action="{{ route('resend-verification-email', ['id' => $user->id]) }}">
                            @csrf
                            <button type="submit" class="btn btn-primary w-100">إعادة إرسال البريد</button>
                        </form>
                    @else
                        <p class="text-danger">المستخدم غير موجود أو لم يتم تمرير البيانات بشكل صحيح.</p>
                    @endisset

                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>