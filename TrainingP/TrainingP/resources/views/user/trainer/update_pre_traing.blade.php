@php
  use Illuminate\Support\Facades\Auth;
  $trainer = Auth::user()->trainer;
@endphp
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <title>تعديل فيديو تدريب سابق</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f9f9f9;
      font-family: 'Segoe UI', sans-serif;
    }

    .form-section {
      background: white;
      border-radius: 16px;
      padding: 2rem;
      box-shadow: 0 0 12px rgba(0,0,0,0.05);
      max-width: 800px;
      margin: 2rem auto;
    }

    .form-label {
      font-weight: bold;
    }

    textarea {
      resize: none;
    }
  </style>
</head>
<body>

<div class="container">
  <div class="form-section">
    <h4 class="text-center mb-4">تعديل فيديو تدريب سابق</h4>

    @if ($errors->any())
      <div class="alert alert-danger">
        <ul class="mb-0">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif
    {{-- @dd($trainer->previousTraining); --}}
    <form method="POST" action="{{ route('update_pre_trainig', $trainer->previousTraining->id) }}">
      @csrf

      @method('PUT')

      <!-- رابط الفيديو -->
      <div class="mb-3">
        <label class="form-label">رابط الفيديو <span class="text-danger">*</span></label>
        <small class="text-muted d-block mb-2">أضف رابطاً لفيديو تدريب قدمته (YouTube, Drive, Dropbox...). تأكد أن الرابط قابل للمشاهدة.</small>
        <input type="url" name="video_link" class="form-control" placeholder="اكتب هنا"
               value="{{ old('video_link', $trainer->previousTraining->video_link) }}" required>
      </div>

      <!-- عنوان التدريب -->
      <div class="mb-3">
        <label class="form-label">عنوان التدريب <span class="text-danger">*</span></label>
        <input type="text" name="taining_title" class="form-control" placeholder="اكتب هنا"
               value="{{ old('taining_title', $trainer->previousTraining->taining_title) }}" required>
      </div>

      <!-- وصف التدريب -->
      <div class="mb-3">
        <label class="form-label">وصف التدريب <span class="text-danger">*</span></label>
        <textarea name="description" class="form-control" rows="3" required
                  placeholder="اشرح باختصار ما يتناوله هذا المقطع، وما المواضيع أو المهارات التي يغطيها">{{ old('description', $trainer->previousTraining->description) }}</textarea>
      </div>

      <div class="text-center mt-4">
        <button type="submit" class="btn btn-primary px-5">
          ← حفظ التعديل
        </button>
      </div>
    </form>
  </div>
</div>

</body>
</html>
