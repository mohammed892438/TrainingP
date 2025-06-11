<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Trainer Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        .profile-header {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            border-radius: 10px;
            padding: 2rem;
            margin-bottom: 2rem;
        }
        .profile-img {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border: 5px solid white;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .card {
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            margin-bottom: 20px;
            border: none;
        }
        .card-header {
            background-color: #f8f9fa;
            border-bottom: 1px solid rgba(0,0,0,0.05);
            font-weight: 600;
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
        .info-item {
            margin-bottom: 0.8rem;
            padding-bottom: 0.8rem;
            border-bottom: 1px dashed #eee;
        }
        .info-item:last-child {
            border-bottom: none;
        }
        .portfolio-item {
            transition: transform 0.3s ease;
        }
        .portfolio-item:hover {
            transform: translateY(-5px);
        }
        .badge-custom {
            background-color: #e3f2fd;
            color: #1976d2;
            font-weight: 500;
            padding: 5px 10px;
            border-radius: 20px;
        }
    </style>
</head>
<body>
<div class="container py-4">
    <!-- Profile Header -->
    <div class="profile-header d-flex flex-column flex-md-row align-items-center">
        <div class="text-center mb-3 mb-md-0 me-md-4">
            @if($user->photo)
                <img src="{{ asset('storage/' . $user->photo) }}" class="profile-img rounded-circle">
            @else
                <div class="profile-img rounded-circle bg-light d-flex align-items-center justify-content-center">
                    <i class="bi bi-person-fill" style="font-size: 4rem; color: #ccc;"></i>
                </div>
            @endif
        </div>
        <div class="flex-grow-1 text-center text-md-start">
            <h2 class="mb-2">{{ $user->name }} {{ $trainer->last_name }}</h2>
            <h5 class="text-muted mb-3">{{ $trainer->headline }}</h5>
            <div class="d-flex flex-wrap justify-content-center justify-content-md-start gap-2 mb-3">
                <span class="badge-custom"><i class="bi bi-geo-alt me-1"></i> {{ $user->city }}, {{ $user->country->name }}</span>
                <span class="badge-custom"><i class="bi bi-cash-coin me-1"></i> ${{ $trainer->hourly_wage }}/hr</span>
                <span class="badge-custom"><i class="bi bi-award me-1"></i> {{ $trainer->status }}</span>
            </div>
            <p class="text-muted">{{ $user->bio }}</p>
        </div>
        <div class="mt-3 mt-md-0">
            <a href="{{ route('edit_trainer_profile') }}" class="btn btn-warning">
                <i class="bi bi-pencil-square me-1"></i> تعديل المعلومات
            </a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="row">
        <!-- Left Column -->
        <div class="col-lg-8">
            <!-- About Section -->
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="bi bi-person-lines-fill me-2"></i>معلومات التواصل</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="info-item">
                                <strong><i class="bi bi-envelope me-2"></i>البريد الإلكتروني:</strong>
                                <p class="mb-0">{{ $user->email }}</p>
                            </div>
                            <div class="info-item">
                                <strong><i class="bi bi-telephone me-2"></i>رقم الهاتف:</strong>
                                <p class="mb-0">{{ $user->phone_number }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-item">
                                <strong><i class="bi bi-geo-alt me-2"></i>الموقع:</strong>
                                <p class="mb-0">{{ $user->city }}, {{ $user->country->name }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Experience Summary -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0"><i class="bi bi-briefcase me-2"></i>ملخص الخبرات</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <h6 class="section-title">الخدمات المقدمة</h6>
                            <ul class="list-unstyled">
                                @foreach ($providedServices as $service)
                                    <li class="mb-2">
                                        <i class="bi bi-check-circle-fill text-success me-2"></i>
                                        {{ $service->name }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="col-md-4 mb-3">
                            <h6 class="section-title">مجالات العمل</h6>
                            <ul class="list-unstyled">
                                @foreach ($workSectors as $workSector)
                                    <li class="mb-2">
                                        <i class="bi bi-briefcase-fill text-primary me-2"></i>
                                        {{ $workSector->name }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="col-md-4 mb-3">
                            <h6 class="section-title">المواضيع المهمة</h6>
                            <ul class="list-unstyled">
                                @foreach ($importantTopics as $topic)
                                    <li class="mb-2">
                                        <i class="bi bi-bookmark-star-fill text-warning me-2"></i>
                                        {{ $topic }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Work Experience -->
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="bi bi-building me-2"></i>الخبرات العملية</h5>
                    <a href="{{ route('workExperience.create') }}" class="btn btn-sm btn-primary">
                        <i class="bi bi-plus"></i> إضافة
                    </a>
                </div>
                <div class="card-body">
                    @foreach ($workexperiences as $experience)
                        <div class="mb-4 pb-3 border-bottom">
                            <div class="d-flex justify-content-between">
                                <h6 class="fw-bold">{{ $experience->the_authority ?? 'N/A' }}</h6>
                                <div>
                                    <a href="{{ route('workExperience.edit', $experience->id) }}" class="btn btn-sm btn-outline-secondary">
                                        <i class="bi bi-pencil"></i> تعديل
                                    </a>
                                </div>
                            </div>
                            <div class="d-flex text-muted small mb-2">
                                <span class="me-3">
                                    <i class="bi bi-calendar me-1"></i>
                                    {{ $experience->start_date ?? 'N/A' }} - {{ $experience->end_date ?? 'مستمر' }}
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Training Experience -->
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="bi bi-mortarboard me-2"></i>الخبرات التدريبية</h5>
                    <a href="{{ route('trainingExperience.create') }}" class="btn btn-sm btn-primary">
                        <i class="bi bi-plus"></i> إضافة
                    </a>
                </div>
                <div class="card-body">
                    @foreach ($trainingexperiences as $trainingexperience)
                        <div class="mb-4 pb-3 border-bottom">
                            <div class="d-flex justify-content-between">
                                <h6 class="fw-bold">{{ $trainingexperience->title_id ? $trainingexperience->title->name : 'N/A' }}</h6>
                                <div>
                                    <a href="{{ route('trainingExperience.edit', $trainingexperience->id) }}" class="btn btn-sm btn-outline-secondary">
                                        <i class="bi bi-pencil"></i> تعديل
                                    </a>
                                </div>
                            </div>
                            <div class="d-flex flex-wrap text-muted small mb-2">
                                <span class="me-3">
                                    <i class="bi bi-building me-1"></i> {{ $trainingexperience->authority }}
                                </span>
                                <span class="me-3">
                                    <i class="bi bi-people me-1"></i> {{ $trainingexperience->trainees_number }} متدرب
                                </span>
                                <span class="me-3">
                                    <i class="bi bi-clock me-1"></i> {{ $trainingexperience->hours_number }} ساعة
                                </span>
                            </div>
                            <p class="mb-2">{{ $trainingexperience->description }}</p>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Portfolio -->
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="bi bi-folder me-2"></i>محفظة الأعمال</h5>
                    <a href="{{ route('portfolio.create') }}" class="btn btn-sm btn-primary">
                        <i class="bi bi-plus"></i> إضافة
                    </a>
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach($Portfolios as $portfolio)
                            <div class="col-md-6 mb-4">
                                <div class="card portfolio-item h-100">
                                    @if($portfolio->photo)
                                        <img src="{{ asset('storage/' . $portfolio->photo) }}" class="card-img-top" alt="{{ $portfolio->title }}">
                                    @else
                                        <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 150px;">
                                            <i class="bi bi-file-earmark-text" style="font-size: 3rem; color: #ccc;"></i>
                                        </div>
                                    @endif
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $portfolio->title }}</h5>
                                    </div>
                                    <div class="card-footer bg-transparent d-flex justify-content-between">
                                        @php $isUrl = filter_var($portfolio->file, FILTER_VALIDATE_URL); @endphp
                                        @if($isUrl)
                                            <a href="{{ $portfolio->file }}" target="_blank" class="btn btn-outline-primary btn-sm">
                                                <i class="bi bi-link-45deg"></i> عرض الرابط
                                            </a>
                                        @else
                                            <a href="{{ asset('storage/' . $portfolio->file) }}" class="btn btn-outline-info btn-sm" download>
                                                <i class="bi bi-download"></i> تحميل
                                            </a>
                                        @endif
                                        <a href="{{ route('portfolio.edit', $portfolio->id) }}" class="btn btn-outline-secondary btn-sm">
                                            <i class="bi bi-pencil"></i> تعديل
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column -->
        <div class="col-lg-4">
            <!-- CV Section -->
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="bi bi-file-earmark-text me-2"></i>السيرة الذاتية</h5>
                    <a href="{{ route('trainerCv.create') }}" class="btn btn-sm btn-primary">
                        <i class="bi bi-plus"></i> إضافة
                    </a>
                </div>
                <div class="card-body text-center">
                    @if (!empty($trainercv->cv_file))
                        <i class="bi bi-file-earmark-pdf text-danger" style="font-size: 3rem;"></i>
                        <div class="mt-3">
                            <a href="{{ asset('storage/' . $trainercv->cv_file) }}" class="btn btn-success" download>
                                <i class="bi bi-download me-1"></i> تحميل السيرة الذاتية
                            </a>
                        </div>
                    @else
                        <i class="bi bi-file-earmark-excel text-secondary" style="font-size: 3rem;"></i>
                        <p class="mt-2 text-muted">لا يوجد ملف مرفوع</p>
                    @endif
                </div>
            </div>

            <!-- Education -->
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="bi bi-mortarboard me-2"></i>التعليم</h5>
                    <a href="{{ route('education.create') }}" class="btn btn-sm btn-primary">
                        <i class="bi bi-plus"></i> إضافة
                    </a>
                </div>
                <div class="card-body">
                    @foreach ($educations as $education)
                        <div class="mb-3 pb-2 border-bottom">
                            <div class="d-flex justify-content-between">
                                <h6 class="fw-bold">{{ $education->specialization ?? 'N/A' }}</h6>
                                <div>
                                    <a href="{{ route('education.edit', $education->id) }}" class="btn btn-sm btn-outline-secondary">
                                        <i class="bi bi-pencil"></i> تعديل
                                    </a>
                                </div>
                            </div>
                            <p class="mb-1 small">{{ $education->university ?? 'N/A' }}</p>
                            <div class="d-flex text-muted small">
                                <span class="me-3">
                                    <i class="bi bi-award me-1"></i>
                                    {{ $education->educationLevel->name ?? 'N/A' }}
                                </span>
                                <span>
                                    <i class="bi bi-calendar me-1"></i>
                                    {{ $education->graduation_year ?? 'مستمر' }}
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Certificates -->
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="bi bi-award me-2"></i>الشهادات الاحترافية</h5>
                    <a href="{{ route('userCertificates.create') }}" class="btn btn-sm btn-primary">
                        <i class="bi bi-plus"></i> إضافة
                    </a>
                </div>
                <div class="card-body">
                    @foreach ($Certificates as $Certificate)
                        <div class="mb-3 pb-2 border-bottom">
                            <div class="d-flex justify-content-between">
                                <h6 class="fw-bold">{{ $Certificate->certificate->name ?? 'N/A' }}</h6>
                                <div>
                                    <a href="{{ route('userCertificates.edit', $Certificate->id) }}" class="btn btn-sm btn-outline-secondary">
                                        <i class="bi bi-pencil"></i> تعديل
                                    </a>
                                </div>
                            </div>
                            <p class="mb-1 small">{{ $Certificate->certificate->issuer ?? 'N/A' }}</p>
                            <div class="text-muted small">
                                <i class="bi bi-calendar me-1"></i>
                                {{ $Certificate->issue_date ?? 'N/A' }}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Volunteering -->
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="bi bi-heart me-2"></i>التطوع</h5>
                    <a href="{{ route('volunteerings.create') }}" class="btn btn-sm btn-primary">
                        <i class="bi bi-plus"></i> إضافة
                    </a>
                </div>
                <div class="card-body">
                    @foreach ($volunteerings as $volunteering)
                        <div class="mb-3 pb-2 border-bottom">
                            <div class="d-flex justify-content-between">
                                <h6 class="fw-bold">{{ $volunteering->serviceType->name ?? 'N/A' }}</h6>
                                <div>
                                    <a href="{{ route('volunteerings.edit', $volunteering->id) }}" class="btn btn-sm btn-outline-secondary">
                                        <i class="bi bi-pencil"></i> تعديل
                                    </a>
                                </div>
                            </div>
                            <div class="d-flex text-muted small mb-2">
                                <span class="me-3">
                                    <i class="bi bi-clock me-1"></i>
                                    {{ $volunteering->mounthly_hours ?? 'N/A' }} ساعات/شهر
                                </span>
                            </div>
                            @if(count($volunteering->training_titles) > 0)
                                <div class="mb-2">
                                    <strong class="small">عناوين التدريب:</strong>
                                    <div class="d-flex flex-wrap gap-1 mt-1">
                                        @foreach($volunteering->training_titles as $title)
                                            <span class="badge bg-light text-dark">{{ $title }}</span>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Skills -->
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="bi bi-tools me-2"></i>المهارات</h5>
                    <a href="{{ route('skills.create') }}" class="btn btn-sm btn-primary">
                        <i class="bi bi-plus"></i> إضافة
                    </a>
                </div>
                <div class="card-body">
                    <div class="d-flex flex-wrap gap-2">
                        @foreach ($skills as $skill)
                            <div class="d-flex align-items-center bg-light rounded-pill px-3 py-1">
                                <span>{{ $skill->name ?? 'N/A' }}</span>
                                <a href="{{ route('skills.edit', $skill->id) }}" class="btn btn-sm btn-link p-0 ms-2">
                                    <i class="bi bi-pencil text-secondary"></i>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Services -->
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="bi bi-list-check me-2"></i>الخدمات</h5>
                    <a href="{{ route('services.create') }}" class="btn btn-sm btn-primary">
                        <i class="bi bi-plus"></i> إضافة
                    </a>
                </div>
                <div class="card-body">
                    @foreach ($services as $service)
                        <div class="mb-3 pb-2 border-bottom">
                            <div class="d-flex justify-content-between">
                                <h6 class="fw-bold">{{ $service->title }}</h6>
                                <div>
                                    <a href="{{ route('services.edit', $service->id) }}" class="btn btn-sm btn-outline-secondary">
                                        <i class="bi bi-pencil"></i> تعديل
                                    </a>
                                </div>
                            </div>
                            <p class="small mb-2">{{ Str::limit($service->description, 80) }}</p>
                            <div class="d-flex flex-wrap text-muted small gap-2">
                                <span class="badge bg-light text-dark">
                                    <i class="bi bi-cash-coin me-1"></i> ${{ number_format($service->hourly_wage, 2) }}
                                </span>
                                @if(is_array($service->training_areas))
                                    @foreach(array_slice($service->training_areas, 0, 2) as $area)
                                        <span class="badge bg-light text-dark">{{ $area }}</span>
                                    @endforeach
                                    @if(count($service->training_areas) > 2)
                                        <span class="badge bg-light text-dark">+{{ count($service->training_areas) - 2 }}</span>
                                    @endif
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>