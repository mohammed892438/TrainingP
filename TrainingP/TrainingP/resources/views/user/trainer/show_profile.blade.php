<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>الملف الشخصي للمدرب</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body { background-color: #f9f9f9; font-family: 'Segoe UI', sans-serif; }
    .card-custom { background: white; border-radius: 16px; padding: 1.5rem; box-shadow: 0 0 12px rgba(0,0,0,0.05); margin-bottom: 1.5rem; }
    .profile-img { border-radius: 12px; width: 100%; max-width: 180px; }
    .section-title { font-weight: bold; margin-bottom: 1rem; font-size: 1.1rem; }
    .profile-sidebar .btn { font-size: 0.875rem; }
    .badge-custom { background-color: #e3f2fd; color: #1976d2; font-weight: 500; padding: 5px 10px; border-radius: 20px; }
  </style>
</head>
<body>

<div class="container py-5">
  <div class="row">
    <!-- Sidebar -->
    <div class="col-lg-4 mb-4">
      <div class="card-custom profile-sidebar text-center">

        @if($user->photo)
          <img src="{{ asset('storage/' . $user->photo) }}" class="profile-img mb-3" alt="Trainer Photo">
        @else
          <div class="profile-img bg-light d-flex align-items-center justify-content-center mb-3" style="height: 180px;">
            <i class="bi bi-person-fill" style="font-size: 4rem; color: #ccc;"></i>
          </div>
        @endif
        <h5 class="mb-0">{{ $user->name }} {{ $trainer->last_name }}</h5>
        <p class="text-muted">{{ $trainer->headline }}</p>
        <div class="d-flex flex-column align-items-center gap-2">
          <span class="badge-custom"><i class="bi bi-geo-alt me-1"></i> {{ $user->city }}, {{ $user->country->name }}</span>
          <span class="badge-custom"><i class="bi bi-cash-coin me-1"></i> ${{ $trainer->hourly_wage }}/hr</span>
          <span class="badge-custom"><i class="bi bi-award me-1"></i> {{ $trainer->status }}</span>
        </div>
        <div class="mt-3">
            <a href="{{ route('edit_personal_info') }}" class="btn btn-warning w-100">
              <i class="bi bi-pencil-square me-1"></i>   تعديل المعلومات الشخصية
            </a>
        </div>
        <div class="text-start mt-4">
          <p class="section-title">معلومات التواصل</p>
          <p class="small"><i class="bi bi-envelope me-2"></i>{{ $user->email }}</p>
          <p class="small"><i class="bi bi-telephone me-2"></i>{{ $user->phone_number }}</p>
          <p class="small"><i class="bi bi-geo-alt me-2"></i>{{ $user->city }}, {{ $user->country->name }}</p>

          <div class="mt-3">
            <a href="{{ route('edit_contact_info') }}" class="btn btn-warning w-100">
              <i class="bi bi-pencil-square me-1"></i>   تعديل معلومات التواصل
            </a>
        </div>

        </div>

      </div>
    </div>


    <!-- Main Profile Sections -->
    <div class="col-lg-8">
      <!-- Experience Summary -->
      <div class="card-custom">
        <p class="section-title">ملخص الخبرات</p>
        <div class="row">
          <div class="col-md-3 mb-3">
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
          <div class="col-md-3 mb-3">
            <h6 class="section-title">قطاعات العمل</h6>
            <ul class="list-unstyled">
              @foreach ($workSectors as $workSector)
                <li class="mb-2">
                  <i class="bi bi-briefcase-fill text-primary me-2"></i>
                  {{ $workSector->name }}
                </li>
              @endforeach
            </ul>
          </div>
          <div class="col-md-3 mb-3">
            <h6 class="section-title">مجالات العمل</h6>
            <ul class="list-unstyled">
              @foreach ($workFields as $workField)
                <li class="mb-2">
                  <i class="bi bi-lightning-fill text-warning me-2"></i>
                  {{ $workField->name }}
                </li>
              @endforeach
            </ul>
          </div>
          <div class="col-md-3 mb-3">
            <h6 class="section-title">المواضيع المهمة</h6>
            @php
              $topics = is_array($trainer->important_topics) ? $trainer->important_topics : json_decode($trainer->important_topics, true);
            @endphp
            @if(is_array($topics) && count($topics) > 0)
              @foreach($topics as $topic)
                <span class="badge bg-dark text-white me-1">{{ $topic['value'] ?? '' }}</span>
              @endforeach
            @else
              <p>لا توجد مواضيع مهمة</p>
            @endif
          </div>
          <div class="mt-3">
            <a href="{{ route('edit_experiance') }}" class="btn btn-warning w-100">
              <i class="bi bi-pencil-square me-1"></i>   تعديل  الخبرات
            </a>
        </div>
        </div>
    </div>

 <!-- Training Video Section -->
<div class="card-custom text-center">
    <p class="section-title">مقطع من تدريب سابق</p>
    <p class="text-muted small">ارفع مقطع قصير من تدريبك السابق لمساعدتنا على تقييم أسلوبك</p>

    <a href="{{ route('create_pre_trainig') }}" class="btn btn-outline-primary btn-sm mb-3">
      <i class="bi bi-upload"></i> ارفع مقطع من تدريب سابق
    </a>

    @if($trainer->previousTraining)
      <div class="mt-4 text-start border rounded p-3 bg-light">
        <p class="mb-1"><strong>العنوان:</strong> {{ $trainer->previousTraining->taining_title }}</p>
        <p class="mb-1"><strong>الوصف:</strong> {{ $trainer->previousTraining->description }}</p>
        <p class="mb-2"><strong>الرابط:</strong> <a href="{{ $trainer->previousTraining->video_link }}" target="_blank">{{ $trainer->previousTraining->video_link }}</a></p>


        <div class="d-flex gap-2">
          <a href="{{ route('edit_pre_trainig', $trainer->previousTraining->id) }}" class="btn btn-warning btn-sm">
            <i class="bi bi-pencil-square"></i> تعديل
          </a>

          <form action=" {{ route('delete_pre_training', $trainer->previousTraining->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من حذف هذا التدريب؟');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-sm">
              <i class="bi bi-trash"></i> حذف
            </button>
          </form>
        </div>
      </div>
    @else
      <p class="text-muted">لا توجد تدريبات مضافة بعد.</p>
    @endif
  </div>

      <!-- CV Section -->
      <div class="card-custom text-center">
        <p class="section-title">السيرة الذاتية CV</p>
        @if (!empty($user->trainerCv->cv_file))
  <i class="bi bi-file-earmark-pdf text-danger" style="font-size: 3rem;"></i>
  <div class="mt-3 d-flex justify-content-center gap-3 flex-wrap">
    <a href="{{ asset('storage/' . $user->trainerCv->cv_file) }}" class="btn btn-success" download>
      <i class="bi bi-download me-1"></i> تحميل السيرة الذاتية
    </a>

    <!-- Delete CV Button -->
    <form method="POST" action="{{ route('delete_cv') }}">
      @csrf
      @method('DELETE')
      <button type="submit" class="btn btn-danger">
        <i class="bi bi-trash me-1"></i> حذف السيرة الذاتية
      </button>
    </form>
  </div>
@else

          <i class="bi bi-file-earmark-excel text-secondary" style="font-size: 3rem;"></i>
          <p class="mt-2 text-muted">لا يوجد ملف مرفوع</p>
          <!-- Hidden form -->
<form id="cvUploadForm" action="{{ route('upload_cv') }}" method="POST" enctype="multipart/form-data" style="display: none;">
    @csrf
    <input type="file" name="uploadPdf" id="uploadPdf" onchange="document.getElementById('cvUploadForm').submit();">
</form>



<!-- Visible button styled as a link -->
<a href="#" class="btn btn-primary btn-sm mt-2" onclick="document.getElementById('uploadPdf').click(); return false;">
    <i class="bi bi-plus"></i> إضافة
</a>




        @endif
      </div>
    </div>
  </div>
</div>

</body>
</html>
