<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>إكمال تسجيل المساعد</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body dir="rtl">

<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white text-center">
            <h4 class="mb-0">إكمال تسجيل المساعد</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('assistant.complete-register', $user->id) }}" method="POST">
                @csrf

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="row g-3">

                    <div class="col-md-6">
                        <label class="form-label">الاسم (بالإنجليزية)</label>
                        <input type="text" class="form-control" name="name_en" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">الاسم (بالعربية)</label>
                        <input type="text" class="form-control" name="name_ar" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">الكنية (بالإنجليزية)</label>
                        <input type="text" class="form-control" name="last_name_en" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">الكنية (بالعربية)</label>
                        <input type="text" class="form-control" name="last_name_ar" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">رقم الهاتف</label>
                        <input type="text" class="form-control" name="phone_number" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">المدينة</label>
                        <input type="text" class="form-control" name="city" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">الدولة</label>
                        <select class="form-select" name="country_id" required>
                            @foreach($countries as $country)
                                <option value="{{ $country->id }}">{{ $country->name_ar }}</option>
                            @endforeach
                        </select>
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

                    <div class="col-md-6">
                        <label class="form-label">الجنس</label>
                        <select class="form-select" name="sex" required>
                            @foreach(\App\Enums\SexEnum::cases() as $sex)
                                <option value="{{ $sex->value }}">{{ $sex->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">المسمى الوظيفي</label>
                        <input type="text" class="form-control" name="headline" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">عدد سنوات الخبرة</label>
                        <input type="number" class="form-control" name="years_of_experience" min="0" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">الخدمات المقدمة</label>
                        <select class="form-select" name="provided_services[]" multiple required>
                            @foreach($services as $service)
                                <option value="{{ $service->id }}">{{ $service->name }}</option>
                            @endforeach
                        </select>
                        <small class="text-muted">يمكنك اختيار أكثر من خدمة</small>
                    </div>


                    <div class="col-md-6">
                        <label class="form-label">مجالات الخبرة</label>
                        <select class="form-select" name="experience_areas[]" multiple required>
                            @foreach($experience_areas as $area)
                                <option value="{{ $area->id }}">{{ $area->name }}</option>
                            @endforeach
                        </select>
                        <small class="text-muted">يمكن اختيار أكثر من مجال</small>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">التخصص</label>
                        <input type="text" class="form-control" name="specialization" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">الجامعة</label>
                        <input type="text" class="form-control" name="university" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">سنة التخرج</label>
                        <input type="date" class="form-control" name="graduation_year" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">مستوى التعليم</label>
                        <select class="form-select" name="education_levels_id" required>
                            @foreach($education_levels as $level)
                                <option value="{{ $level->id }}">{{ $level->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">اللغات</label>
                        <select class="form-select" name="languages[]" multiple required>
                            @foreach($languages as $lang)
                                <option value="{{ $lang->id }}">{{ $lang->name }}</option>
                            @endforeach
                        </select>
                    </div>


                    <div class="col-12">
                        <label class="form-label">نبذة تعريفية</label>
                        <textarea class="form-control" name="bio" rows="4"></textarea>
                    </div>

                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-success w-100">إكمال التسجيل</button>
                </div>

            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
