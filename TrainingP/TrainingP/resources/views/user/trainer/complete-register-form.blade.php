<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>إكمال التسجيل</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white text-center">
                    <h4 class="mb-0">إكمال التسجيل</h4>
                </div>

                @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
                <div class="card-body">
                    <form method="POST" action="{{ route('trainer.complete-register', ['id' => $user->id]) }}">
                        @csrf

                        <div class="mb-3">
                            <label for="name_ar" class="form-label">الاسم بالعربية</label>
                            <input type="text" class="form-control" id="name_ar" name="name_ar" required>
                        </div>

                        <div class="mb-3">
                            <label for="name_en" class="form-label">الاسم بالإنجليزية</label>
                            <input type="text" class="form-control" id="name_en" name="name_en" required>
                        </div>

                        <div class="mb-3">
                            <label for="last_name_ar" class="form-label">الاسم الأخير بالعربية</label>
                            <input type="text" class="form-control" id="last_name_ar" name="last_name_ar" required>
                        </div>

                        <div class="mb-3">
                            <label for="last_name_en" class="form-label">الاسم الأخير بالإنجليزية</label>
                            <input type="text" class="form-control" id="last_name_en" name="last_name_en" required>
                        </div>

                        <div class="mb-3">
                            <label for="work_sectors" class="form-label">قطاعات العمل</label>
                            <select class="form-select" id="work_sectors" name="work_sectors[]" multiple required>
                                <option value="" disabled>اختر قطاعات العمل</option>
                                @foreach($work_sectors as $sector)
                                    <option value="{{ $sector->id }}">{{ $sector->name }}</option>
                                @endforeach
                            </select>
                            <small class="text-muted">يمكنك اختيار أكثر من قطاع بالضغط على زر CTRL (في الويندوز) أو CMD (في الماك).</small>
                        </div>


                        <div class="mb-3">
                            <label for="phone_number" class="form-label">رقم الهاتف</label>
                            <input type="text" class="form-control" id="phone_number" name="phone_number" required>
                        </div>

                        <div class="mb-3">
                            <label for="city" class="form-label">المدينة</label>
                            <input type="text" class="form-control" id="city" name="city" required>
                        </div>

                        <div class="mb-3">
                            <label for="country_id" class="form-label">الدولة</label>
                            <select class="form-select" id="country_id" name="country_id" required>
                                <option value="" disabled selected>اختر الدولة</option>
                                @foreach($countries as $country)
                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="bio" class="form-label">نبذة عنك</label>
                            <textarea class="form-control" id="bio" name="bio" rows="3" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="nationality" class="form-label">الجنسية</label>
                            <select class="form-select" id="nationality" name="nationality[]" multiple required>
                                @foreach($nationalities as $nationality)
                                    <option value="{{ $nationality->id }}">{{ $nationality->name }}</option>
                                @endforeach
                            </select>
                            <small class="text-muted">يمكنك اختيار أكثر من جنسية بالضغط على زر CTRL (في الويندوز) أو CMD (في الماك) والنقر على الخيارات.</small>
                        </div>

                        <div class="mb-3">
                            <label for="sex" class="form-label">الجنس</label>
                            <select class="form-select" id="sex" name="sex" required>
                                @foreach($sexs as $sex)
                                    <option value="{{ $sex->value }}">{{ $sex->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="headline" class="form-label">عنوان وظيفي</label>
                            <input type="text" class="form-control" id="headline" name="headline" required>
                        </div>

                        <div class="mb-3">
                            <label for="important_topics" class="form-label">الموضوعات المهمة</label>
                            <input type="text" class="form-control" id="important_topics" name="important_topics" required>
                        </div>

                        <div class="mb-3">
                            <label for="work_fields" class="form-label">مجالات العمل</label>
                            <select class="form-select" id="work_fields" name="work_fields[]" multiple required>
                                <option value="" disabled>اختر مجالات العمل</option>
                                @foreach($work_fields as $field)
                                    <option value="{{ $field->id }}">{{ $field->name }}</option>
                                @endforeach
                            </select>
                            <small class="text-muted">يمكنك اختيار أكثر من مجال بالضغط على زر CTRL (في الويندوز) أو CMD (في الماك).</small>
                        </div>


                        <div class="mb-3">
                            <label for="provided_services" class="form-label">الخدمات المقدمة</label>
                            <select class="form-select" id="provided_services" name="provided_services[]" multiple required>
                                <option value="" disabled>اختر الخدمات المقدمة</option>
                                @foreach($provided_services as $service)
                                    <option value="{{ $service->id }}">{{ $service->name }}</option>
                                @endforeach
                            </select>
                            <small class="text-muted">يمكنك اختيار أكثر من خدمة بالضغط على زر CTRL (في الويندوز) أو CMD (في الماك).</small>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">إكمال التسجيل</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>