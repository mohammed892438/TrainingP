<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>تسجيل حساب جديد</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script>
        function setUserType(userTypeId) {
            document.getElementById('user_type_id').value = userTypeId;
            document.querySelectorAll('.user-type-btn').forEach(btn => btn.classList.remove('btn-primary'));
            document.querySelector(`[data-type="${userTypeId}"]`).classList.add('btn-primary');
        }
    </script>
</head>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white text-center">
                    <h4 class="mb-0">تسجيل حساب جديد</h4>
                </div>
                <div class="card-body">

                    @if(session('success'))
                        <div class="alert alert-success text-center">{{ session('success') }}</div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="mb-3 text-center">
                            <label class="form-label fw-bold">اختر نوع المستخدم</label>
                            <div>
                                <button type="button" class="btn btn-outline-primary user-type-btn mx-1"
                                    data-type="1" onclick="setUserType(3)">متدرب</button>
                                <button type="button" class="btn btn-outline-primary user-type-btn mx-1"
                                    data-type="2" onclick="setUserType(1)">مدرب</button>
                                <button type="button" class="btn btn-outline-primary user-type-btn mx-1"
                                    data-type="3" onclick="setUserType(2)">مساعد</button>
                            </div>
                            <input type="hidden" id="user_type_id" name="user_type_id" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">البريد الإلكتروني</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">كلمة المرور</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">تأكيد كلمة المرور</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">تسجيل الحساب</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>