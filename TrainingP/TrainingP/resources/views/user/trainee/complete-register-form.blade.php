<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>إنشاء حساب متدرب</title>
    <!-- روابط CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Arabic:wght@100;200;300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.19/css/intlTelInput.min.css" />
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/logos/logo.svg') }}">

    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/trainer_complete_profile.css') }}">

</head>

<body>
    <div class="verify-bg mb-5">
        <!-- العنوان الرئيسي -->
        <div class="header">
            <h1 class="page-title">المعلومات 
              <span class="intro-highlighted-text">
                    الرئيسية
                    <img src="../images/cots-style.svg" class="cots-style-img" alt="" />
                </span>
            </h1>
        </div>

        <div class="container-lg">
            <!-- نموذج التسجيل -->
            <div class="form-container">
                <form id="registrationForm" method="POST"
                    action="{{ route('trainee.complete-register', ['id' => $user->id]) }}">
                    @csrf

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">الاسم (بالعربية)</label>
                            <input type="text" id="name_ar" name="name_ar" class="form-control" required
                                placeholder="مثال: أحمد" pattern="[\u0600-\u06FF\s]+"
                                title="يجب أن يحتوي على حروف عربية فقط">
                            <div class="error-message" id="name_ar_error">يجب إدخال الاسم بالعربية بشكل صحيح</div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">الكنية (بالعربية)</label>
                            <input type="text" id="last_name_ar" name="last_name_ar" class="form-control" required
                                placeholder="مثال: العلي" pattern="[\u0600-\u06FF\s]+"
                                title="يجب أن يحتوي على حروف عربية فقط">
                            <div class="error-message" id="last_name_ar_error">يجب إدخال الكنية بالعربية بشكل صحيح</div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">الاسم (بالإنجليزية)</label>
                            <input type="text" id="name_en" name="name_en" required style="direction: ltr"
                                class="form-control" placeholder="Example: Ali" pattern="[A-Za-z\s]+"
                                title="يجب أن يحتوي على حروف إنجليزية فقط">
                            <div class="error-message" id="name_en_error">يجب إدخال الاسم بالإنجليزية بشكل صحيح</div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">الكنية (بالإنجليزية)</label>
                            <input type="text" id="last_name_en" name="last_name_en" required style="direction: ltr"
                                class="form-control" placeholder="Example: Alali" pattern="[A-Za-z\s]+"
                                title="يجب أن يحتوي على حروف إنجليزية فقط">
                            <div class="error-message" id="last_name_en_error">يجب إدخال الكنية بالإنجليزية بشكل صحيح
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">مستوى التعليم</label>
                            <select id="education_levels" name="education_levels_id" class="form-select" required>
                                <option value="" selected disabled>اختر آخر مؤهل دراسي حصلت عليه</option>
                                @foreach ($educatuin_levels as $education_level)
                                    <option value="{{ $education_level->id }}">{{ $education_level->name }}</option>
                                @endforeach
                            </select>
                            <div class="error-message" id="education_levels_error">يجب اختيار مستوى التعليم</div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">مجالات العمل</label>
                            <select class="form-select select2" id="work_fields" name="work_fields[]" multiple
                                data-placeholder="اختر من القائمة أو أضف مجالاً جديداً" required>
                                @foreach ($work_fields as $work_field)
                                    <option value="{{ $work_field->id }}">{{ $work_field->name }}</option>
                                @endforeach
                            </select>
                            <div class="error-message" id="work_fields_error">يجب اختيار مجالات العمل</div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">رقم الهاتف</label>

                            <input type="text" id="phone_number" name="phone_number" required
                                class="form-control phone-ltr" pattern="[0-9]{6,15}"
                                title="يجب أن يحتوي على أرقام فقط (6-15 رقم)" placeholder="مثال: 00963xxxxxxxxx">
                            <div class="error-message" id="phone_number_error">يجب إدخال رقم هاتف صحيح</div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">الجنسية</label>
                            <select id="nationality" class="form-select select2" name="nationality[]" multiple
                                data-placeholder="اختر من القائمة الدولة التي تحمل جنسيتها" required>
                                @foreach ($nationalities as $nationality)
                                    <option value="{{ $nationality->id }}">{{ $nationality->name }}</option>
                                @endforeach
                            </select>
                            <div class="error-message" id="nationality_error">يجب اختيار الجنسية</div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">الدولة</label>
                            <select id="country_id" name="country_id" class="form-select" required>
                                <option value="" selected disabled>اختر دولتك</option>
                                @foreach ($countries as $country)
                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                                @endforeach
                            </select>
                            <div class="error-message" id="country_id_error">يجب اختيار الدولة</div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">المدينة</label>
                            <select id="city" name="city" class="form-select" required>
                                <option value="" selected disabled>اختر المدينة</option>
                            </select>
                            <div class="error-message" id="city_error">يجب اختيار المدينة</div>
                        </div>
                        <div class="col-md-12 d-flex gap-3 align-items-center mt-4">
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
                        <div class="error-message" id="gender_error">يجب اختيار الجنس</div>
                    </div>
    
            <button type="button" onclick="validateForm()" class="btn btn-primary w-100 mt-4">تسجيل</button>
            </div>
          </form>

            <!-- عرض الأخطاء والرسائل -->
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
        </div>
    </div>
    </div>

    <!-- روابط JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.19/js/intlTelInput.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.19/js/utils.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        function showError(elementId, errorId, message) {
            const element = document.getElementById(elementId);
            const errorElement = document.getElementById(errorId);

            if (element) {
                element.classList.add('is-invalid');
            }

            if (errorElement) {
                errorElement.textContent = message;
                errorElement.style.display = 'block';
            }
        }

        function hideError(elementId, errorId) {
            const element = document.getElementById(elementId);
            const errorElement = document.getElementById(errorId);

            if (element) {
                element.classList.remove('is-invalid');
            }

            if (errorElement) {
                errorElement.style.display = 'none';
            }
        }


        function handleSelect2Validation(id, isValid) {
            const container = $('#' + id).next('.select2-container');
            if (!isValid) {
                container.addClass('is-invalid');
            } else {
                container.removeClass('is-invalid');
            }
        }


        // تحقق من صحة الحقول المحددة
        function validateFields(fields) {
            let isValid = true;

            fields.forEach(field => {
                const element = document.getElementById(field.id);
                const value = field.isSelect2 ? $(element).val() : element.value;

                if (!field.validation(value)) {
                    showError(field.id, field.errorId, field.errorMessage);

                    // معالجة خاصية select2
                    if (field.isSelect2) {
                        handleSelect2Validation(field.id, false);
                    }

                    isValid = false;
                } else {
                    hideError(field.id, field.errorId);

                    if (field.isSelect2) {
                        handleSelect2Validation(field.id, true);
                    }
                }


            });
            if (isValid) {
                document.getElementById('registrationForm').submit(); // إرسال يدوي
            }
        }


        // تحقق نهائي قبل الإرسال
        function validateForm() {
            const fields = [{
                    id: 'name_ar',
                    errorId: 'name_ar_error',
                    validation: (value) => value && /^[\u0600-\u06FF\s]+$/.test(value),
                    errorMessage: 'يجب إدخال الاسم بالعربية بشكل صحيح',
                    isSelect2: false
                },
                {
                    id: 'last_name_ar',
                    errorId: 'last_name_ar_error',
                    validation: (value) => value && /^[\u0600-\u06FF\s]+$/.test(value),
                    errorMessage: 'يجب إدخال الكنية بالعربية بشكل صحيح',
                    isSelect2: false
                },
                {
                    id: 'name_en',
                    errorId: 'name_en_error',
                    validation: (value) => value && /^[A-Za-z\s]+$/.test(value),
                    errorMessage: 'يجب إدخال الاسم بالإنجليزية بشكل صحيح',
                    isSelect2: false
                },
                {
                    id: 'last_name_en',
                    errorId: 'last_name_en_error',
                    validation: (value) => value && /^[A-Za-z\s]+$/.test(value),
                    errorMessage: 'يجب إدخال الكنية بالإنجليزية بشكل صحيح',
                    isSelect2: false
                },
                {
                    id: 'education_levels',
                    errorId: 'education_levels_error',
                    validation: (value) => value && value !== '',
                    errorMessage: 'يجب اختيار مستوى التعليم',
                    isSelect2: false
                },
                {
                    id: 'work_fields',
                    errorId: 'work_fields_error',
                    validation: (value) => value && value.length > 0,
                    errorMessage: 'يجب اختيار مجالات العمل',
                    isSelect2: true
                },
                {
                    id: 'phone_number',
                    errorId: 'phone_number_error',
                    validation: (value) => value && /^[0-9]{6,15}$/.test(value),
                    errorMessage: 'يجب إدخال رقم هاتف صحيح',
                    isSelect2: false
                },
                {
                    id: 'nationality',
                    errorId: 'nationality_error',
                    validation: (value) => value && value.length > 0,
                    errorMessage: 'يجب اختيار الجنسية',
                    isSelect2: true
                },
                {
                    id: 'country_id',
                    errorId: 'country_id_error',
                    validation: (value) => value && value !== '',
                    errorMessage: 'يجب اختيار الدولة',
                    isSelect2: false
                },
                {
                    id: 'city',
                    errorId: 'city_error',
                    validation: (value) => value && value !== '',
                    errorMessage: 'يجب اختيار المدينة',
                    isSelect2: false
                }
            ];
            // التحقق اليدوي من اختيار الجنس
            const genderSelected = document.querySelector('input[name="sex"]:checked');
            const genderError = document.getElementById('gender_error');
            if (!genderSelected) {
                genderError.style.display = 'block';
                isValid = false;
            } else {
                genderError.style.display = 'none';
            }
            return validateFields(fields);
        }

        // تهيئة الصفحة عند التحميل
        window.addEventListener('load', () => {
            // تهيئة select2
            $(document).ready(function() {
                $('.select2').select2({
                    width: '100%',
                    dir: 'rtl'
                });
            });
        });
        // جلب بيانات المدن عند تغيير الدولة
        $(document).ready(function() {
            $('#country_id').on('change', function() {
                var selected_country_id = $(this).val();
                $('#city').empty().append(
                    '<option value="" selected disabled>اختر المدينة</option>');

                fetch('/cities')
                    .then(response => response.json())
                    .then(data => {
                        let filteredCities = data.filter(city => city.country_id ==
                            selected_country_id);
                        filteredCities.forEach(city => {
                            let option = new Option(city.name, city.name);
                            $('#city').append(option);
                        });
                    })
                    .catch(error => {
                        console.error("Error fetching cities:", error);
                    });
            });
        });
    </script>
</body>

</html>
