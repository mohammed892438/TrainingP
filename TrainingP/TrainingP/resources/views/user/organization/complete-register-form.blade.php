<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>إكمال تسجيل المؤسسة</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white text-center">
                    <h4 class="mb-0">إكمال تسجيل المؤسسة</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('organization-complete-register', $user->id) }}" method="POST">
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

                        <div class="mb-3">
                            <label for="name_en" class="form-label">اسم المؤسسة (بالإنجليزية)</label>
                            <input type="text" class="form-control" id="name_en" name="name_en" required>
                        </div>

                        <div class="mb-3">
                            <label for="name_ar" class="form-label">اسم المؤسسة (بالعربية)</label>
                            <input type="text" class="form-control" id="name_ar" name="name_ar" required>
                        </div>

                        <div class="mb-3">
                            <label for="city" class="form-label">المدينة</label>
                            <input type="text" class="form-control" id="city" name="city" required>
                        </div>

                        <div class="mb-3">
                            <label for="phone_number" class="form-label">رقم الهاتف</label>
                            <input type="tel" class="form-control" id="phone_number" name="phone_number" required>
                        </div>

                        <div class="mb-3">
                            <label for="website" class="form-label">الموقع الإلكتروني</label>
                            <input type="url" class="form-control" id="website" name="website" required>
                        </div>

                        <div class="mb-3">
                            <label for="country_id" class="form-label">الدولة</label>
                            <select class="form-select" id="country_id" name="country_id" required>
                                @foreach($countries as $country)
                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="organization_type_id" class="form-label">نوع المؤسسة</label>
                            <select class="form-select" id="organization_type_id" name="organization_type_id" required>
                                @foreach($organization_type as $type)
                                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="mb-3">
                            <label for="annual_budgets_id" class="form-label">الميزانية السنوية</label>
                            <div class="border rounded p-2">
                                @foreach($annual_budget as $budget)
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="annual_budgets_id" id="budget_{{ $budget->id }}" value="{{ $budget->id }}" required>
                                        <label class="form-check-label text-danger" for="budget_{{ $budget->id }}">{{ $budget->range }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>


                        <div class="mb-3">
                            <label for="employee_numbers_id" class="form-label">عدد الموظفين</label>
                            <select class="form-select" id="employee_numbers_id" name="employee_numbers_id" required>
                                @foreach($employee_number as $number)
                                    <option value="{{ $number->id }}">{{ $number->range }}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="mb-3">
                            <label for="organization_sectors" class="form-label">القطاع</label>
                            <select class="form-select" id="organization_sectors" name="organization_sectors[]" multiple required>
                                @foreach($organization_sectors as $sector)
                                    <option value="{{ $sector->id }}">{{ $sector->name }}</option>
                                @endforeach
                            </select>
                            <small class="text-muted">يمكنك اختيار أكثر من قطاع</small>
                        </div>

                        <div class="mb-3">
                            <label for="established_year" class="form-label">سنة التأسيس</label>
                            <select class="form-select" id="established_year" name="established_year" required>
                                @for($year = date('Y'); $year >= 1900; $year--)
                                    <option value="{{ $year }}">{{ $year }}</option>
                                @endfor
                            </select>
                        </div>


                        <div class="mb-3">
                            <label for="bio" class="form-label">النبذة</label>
                            <textarea class="form-control" id="bio" name="bio" rows="3" required></textarea>
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