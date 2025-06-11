<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تعديل الملف الشخصي</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        .profile-edit-container {
            max-width: 1200px;
            margin: 0 auto;
        }
        .card {
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            margin-bottom: 25px;
            border: none;
        }
        .card-header {
            background-color: #f8f9fa;
            border-bottom: 1px solid rgba(0,0,0,0.05);
            font-weight: 600;
            padding: 1rem 1.5rem;
            font-size: 1.1rem;
        }
        .card-body {
            padding: 1.5rem;
        }
        .form-label {
            font-weight: 500;
            margin-bottom: 0.5rem;
        }
        .form-control, .form-select {
            border-radius: 8px;
            padding: 0.5rem 1rem;
            border: 1px solid #ced4da;
        }
        .form-control:focus, .form-select:focus {
            border-color: #86b7fe;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.1);
        }
        .profile-photo-container {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            overflow: hidden;
            border: 5px solid #fff;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            margin: 0 auto 1.5rem;
            background-color: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .profile-photo-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .profile-photo-placeholder {
            font-size: 3rem;
            color: #adb5bd;
        }
        .btn-submit {
            padding: 0.6rem 2rem;
            font-weight: 500;
            border-radius: 8px;
        }
        .select2-container--default .select2-selection--multiple {
            border-radius: 8px !important;
            min-height: 42px;
        }
        .section-title {
            color: #3a7bd5;
            font-weight: 600;
            margin-bottom: 1.5rem;
            position: relative;
        }
        .section-title:after {
            content: "";
            position: absolute;
            bottom: -8px;
            left: 0;
            width: 50px;
            height: 3px;
            background: #3a7bd5;
        }
        .radio-group {
            display: flex;
            gap: 1rem;
            padding: 0.5rem 0;
        }
        .radio-group .form-check {
            display: flex;
            align-items: center;
        }
        .radio-group .form-check-input {
            margin-left: 0.5rem;
            margin-top: 0;
        }
    </style>
</head>
<body>
<div class="container profile-edit-container mt-4 mb-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0"><i class="bi bi-person-gear me-2"></i>تعديل الملف الشخصي</h2>
        <a href="{{ route('show_trainer_profile') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-right me-1"></i> العودة
        </a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <div class="d-flex align-items-center">
                <i class="bi bi-exclamation-triangle-fill me-2" style="font-size: 1.5rem;"></i>
                <h5 class="mb-0">حدث خطأ!</h5>
            </div>
            <ul class="mt-2 mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('update_trainer_profile') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- صورة الملف الشخصي -->
        <div class="card">
            <div class="card-header">
                <i class="bi bi-camera me-2"></i>صورة الملف الشخصي
            </div>
            <div class="card-body text-center">
                <div class="profile-photo-container">
                    @if($user->profile_photo_path)
                        <img src="{{ asset('storage/' . $user->profile_photo_path) }}" alt="الصورة الحالية">
                    @else
                        <i class="bi bi-person-fill profile-photo-placeholder"></i>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="profile_photo" class="form-label">تحديث الصورة</label>
                    <input type="file" id="profile_photo" name="profile_photo" class="form-control">
                    <small class="text-muted">الصور الموصى بها تكون مربعة وبجودة عالية</small>
                </div>
            </div>
        </div>

        <!-- معلومات المستخدم -->
        <div class="card">
            <div class="card-header">
                <i class="bi bi-person-lines-fill me-2"></i>معلومات التواصل
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="name_ar" class="form-label">الاسم (عربي)</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-translate"></i></span>
                            <input type="text" id="name_ar" name="name_ar" class="form-control" value="{{ $user->getTranslation('name', 'ar') }}">
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="name_en" class="form-label">الاسم (إنجليزي)</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-translate"></i></span>
                            <input type="text" id="name_en" name="name_en" class="form-control" value="{{ $user->getTranslation('name', 'en') }}">
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label">البريد الإلكتروني</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                            <input type="email" id="email" name="email" class="form-control" value="{{ $user->email }}">
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="phone_number" class="form-label">رقم الهاتف</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-telephone"></i></span>
                            <input type="text" id="phone_number" name="phone_number" class="form-control" value="{{ $user->phone_number }}">
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="city" class="form-label">المدينة</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-geo-alt"></i></span>
                            <input type="text" id="city" name="city" class="form-control" value="{{ $user->city }}">
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="country_id" class="form-label">الدولة</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-globe"></i></span>
                            <select id="country_id" name="country_id" class="form-select">
                                @foreach($nationalities as $country)
                                    <option value="{{ $country->id }}" {{ $user->country_id == $country->id ? 'selected' : '' }}>{{ $country->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-12 mb-3">
                        <label for="bio" class="form-label">نبذة</label>
                        <textarea id="bio" name="bio" class="form-control" rows="4">{{ $user->bio }}</textarea>
                        <small class="text-muted">اكتب وصفًا مختصرًا عن نفسك وخبراتك</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- معلومات المدرب -->
        <div class="card">
            <div class="card-header">
                <i class="bi bi-person-badge me-2"></i>معلومات المدرب
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="last_name_ar" class="form-label">اسم العائلة (عربي)</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-translate"></i></span>
                            <input type="text" id="last_name_ar" name="last_name_ar" class="form-control" value="{{ $trainer->getTranslation('last_name', 'ar') }}">
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="last_name_en" class="form-label">اسم العائلة (إنجليزي)</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-translate"></i></span>
                            <input type="text" id="last_name_en" name="last_name_en" class="form-control" value="{{ $trainer->getTranslation('last_name', 'en') }}">
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="headline" class="form-label">العنوان المهني</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-briefcase"></i></span>
                            <input type="text" id="headline" name="headline" class="form-control" value="{{ $trainer->headline }}">
                        </div>
                        <small class="text-muted">مثال: مدرب معتمد في تطوير الذات</small>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="hourly_wage" class="form-label">الأجر بالساعة</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-currency-dollar"></i></span>
                            <input type="number" id="hourly_wage" name="hourly_wage" class="form-control" value="{{ $trainer->hourly_wage }}">
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="status" class="form-label">الحالة</label>
                        <select id="status" name="status" class="form-select">
                            <option value="متاح طوال الأسبوع" {{ $trainer->status == 'متاح طوال الأسبوع' ? 'selected' : '' }}>متاح طوال الأسبوع</option>
                            <option value="متاح فقط في أيام العطل" {{ $trainer->status == 'متاح فقط في أيام العطل' ? 'selected' : '' }}>متاح فقط في أيام العطل</option>
                            <option value="غير متاح مؤقتًا" {{ $trainer->status == 'غير متاح مؤقتًا' ? 'selected' : '' }}>غير متاح مؤقتًا</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">الجنس</label>
                        <div class="radio-group">
                            @foreach ($sexs as $sex)
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="sex"
                                        id="sex_{{ $sex->value }}" value="{{ $sex->value }}"
                                        {{ old('sex') == $sex->value ? 'checked' : '' }} required>
                                    <label class="form-check-label" for="gender_{{ $sex->value }}">
                                        {{ $sex->value }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">الجنسية</label>
                        <select id="nationality" class="form-select" name="nationality[]"
                            data-placeholder="اختر واحدة أو أكثر" multiple required>
                            @foreach ($nationalities as $nationality)
                                <option value="{{ $nationality->id }}">{{ $nationality->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <!-- الحقول متعددة الخيارات -->
        <div class="card">
            <div class="card-header">
                <i class="bi bi-tags me-2"></i>القطاعات والخدمات والمواضيع
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="work_sectors[]" class="form-label">القطاعات</label>
                        <select multiple name="work_sectors[]" class="form-select">
                            @foreach($workSectors as $sector)
                                <option value="{{ $sector->id }}" {{ in_array($sector->id, $trainer->work_sectors ?? []) ? 'selected' : '' }}>{{ $sector->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="provided_services[]" class="form-label">الخدمات المقدمة</label>
                        <select multiple name="provided_services[]" class="form-select">
                            @foreach($providedServices as $service)
                                <option value="{{ $service->id }}" {{ in_array($service->id, $trainer->provided_services ?? []) ? 'selected' : '' }}>{{ $service->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="work_fields[]" class="form-label">مجالات العمل</label>
                        <select multiple name="work_fields[]" class="form-select">
                            @foreach($workFields as $field)
                                <option value="{{ $field->id }}" {{ in_array($field->id, $trainer->work_fields ?? []) ? 'selected' : '' }}>{{ $field->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12 mb-3">
                        <label for="important_topics[]" class="form-label">المواضيع المهمة</label>
                        <input type="text" name="important_topics[]" class="form-control" value="{{ implode(',', $importantTopics) }}">
                        <small class="text-muted">افصل بين المواضيع بفاصلة (،)</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-between mt-4">
            <button type="reset" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-counterclockwise me-1"></i> إعادة تعيين
            </button>
            <button type="submit" class="btn btn-success btn-submit">
                <i class="bi bi-check-circle me-1"></i> حفظ التعديلات
            </button>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Initialize select2 for multiple select elements
    document.addEventListener('DOMContentLoaded', function() {
        // You can add select2 initialization here if you're using it
        // $('.select2').select2();

        // For better multiple select display
        const multipleSelects = document.querySelectorAll('select[multiple]');
        multipleSelects.forEach(select => {
            select.style.height = 'auto';
        });
    });
</script>
</body>
</html>