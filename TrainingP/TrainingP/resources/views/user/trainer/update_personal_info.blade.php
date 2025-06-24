@php
  use Illuminate\Support\Facades\Auth;
  $user = Auth::user();
@endphp

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>نموذج تعديل الملف الشخصي</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body { background-color: #f9f9f9; font-family: 'Segoe UI', sans-serif; }
    .form-section { background: white; border-radius: 16px; padding: 2rem; box-shadow: 0 0 12px rgba(0,0,0,0.05); }
    .form-control, .form-select { border-radius: 8px; }
    .form-label { font-weight: bold; }
  </style>
</head>
<body>

<div class="container py-5">
  <div class="form-section">
    <form action="{{ route('update_personal_info') }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')

      @if ($errors->any())
          <div class="alert alert-danger">
              <ul class="mb-0">
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
              </ul>
          </div>
      @endif

      <div class="text-center mb-4">
        @if($user->photo)
          <img id="profilePhotoPreview" src="{{ asset('storage/' . $user->photo) }}" class="img-thumbnail mb-2" style="max-width: 150px;">
        @else
          <i class="bi bi-person-circle" style="font-size: 4rem; color: #ccc;"></i>
        @endif

        <!-- Hidden File Input -->
        <input type="file" name="photo" id="photoInput" accept="image/png, image/jpeg" style="display: none;" onchange="document.getElementById('photoLabel').innerText = '✓ تم اختيار صورة جديدة'">

        <!-- Upload Trigger Link -->
        <p class="mt-2">
          <a href="#" onclick="document.getElementById('photoInput').click(); return false;">
            <span id="photoLabel">ارفع صورة شخصية بصيغة واضحة (JPG أو PNG، حد أقصى 5MB)</span>
          </a>
        </p>
      </div>

      <div class="row g-3">
        <!-- Your existing inputs -->
        <div class="col-md-6">
          <label class="form-label">الاسم (بالعربية)</label>
          <input type="text" name="name_ar" class="form-control" value="{{ old('name_ar', $user->name) }}" required>
        </div>
        <div class="col-md-6">
          <label class="form-label">الكنية (بالعربية)</label>
          <input type="text" name="last_name_ar" class="form-control" value="{{ old('last_name_ar', $user->trainer->last_name ?? '') }}" required>
        </div>

        <div class="col-md-6">
          <label class="form-label">الاسم (بالإنجليزية)</label>
          <input type="text" name="name_en" class="form-control" value="{{ old('name_en', $user->name_en) }}" required>
        </div>
        <div class="col-md-6">
          <label class="form-label">الكنية (بالإنجليزية)</label>
          <input type="text" name="last_name_en" class="form-control" value="{{ old('last_name_en', $user->trainer->last_name_en ?? '') }}" required>
        </div>

        <div class="col-md-6">
          <label class="form-label">الجنسية</label>
          <select name="nationality" class="form-select" required>
            <option value="">اختر الجنسية</option>
            <option value="سورية" {{ old('nationality', $user->nationality) == 'سورية' ? 'selected' : '' }}>سورية</option>
            <option value="تركية" {{ old('nationality', $user->nationality) == 'تركية' ? 'selected' : '' }}>تركية</option>
          </select>
        </div>
        <div class="col-md-6">
          <label class="form-label">العنوان Headline (بالعربية)</label>
          <input type="text" name="headline" class="form-control" value="{{ old('headline', $user->trainer->headline ?? '') }}" required>
        </div>

        <div class="col-md-12">
          <label class="form-label">رابط حسابك على منصة لينكدإن</label>
          <input type="url" name="linkedin_url" class="form-control" value="{{ old('linkedin_url', $user->linkedin_url) }}">
        </div>

        <div class="col-md-12">
          <label class="form-label">نبذة عنك</label>
          <textarea name="bio" class="form-control" rows="3" required>{{ old('bio', $user->bio) }}</textarea>
        </div>

        <div class="col-md-6">
          <label class="form-label">الأجر في الساعة</label>
          <input type="number" name="hourly_wage" class="form-control" value="{{ old('hourly_wage', $user->trainer->hourly_wage ?? '') }}">
        </div>
        <div class="col-md-6">
          <label class="form-label">العملة</label>
          <select name="currency" class="form-select">
            <option value="USD" {{ old('currency', $user->trainer->currency ?? '') == 'USD' ? 'selected' : '' }}>دولار أمريكي</option>
            <option value="TRY" {{ old('currency', $user->trainer->currency ?? '') == 'TRY' ? 'selected' : '' }}>ليرة تركية</option>
          </select>
        </div>
      </div>

      <div class="text-center mt-4">
        <button type="submit" class="btn btn-primary px-5">
          <i class="bi bi-save me-1"></i> حفظ التعديل
        </button>
      </div>
    </form>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
