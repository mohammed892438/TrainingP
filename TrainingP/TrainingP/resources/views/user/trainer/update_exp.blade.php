@php
  use Illuminate\Support\Facades\Auth;
  $user = Auth::user();
@endphp

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <title>ملخص الخبرات التدريبية</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Bootstrap RTL -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
  <!-- Select2 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <!-- Tagify CSS -->
  <link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet" />

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
  </style>
</head>
<body>

<div class="container">
  <div class="form-section">
    <h4 class="text-center mb-4">ملخص خبرات التدريب والاستشارات</h4>

    @if ($errors->any())
      <div class="alert alert-danger">
        <ul class="mb-0">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form method="POST" action="{{ route('update_experiance', $user->id) }}">
        @csrf
        @method('PUT')


      <div class="row g-3">
        <!-- قطاع العمل -->
        <div class="col-md-6">
          <label class="form-label">قطاع العمل</label>
          <select class="form-select select2" name="work_sectors[]" multiple required>
            @foreach ($work_sectors as $sector)
              <option value="{{ $sector->id }}">{{ $sector->name }}</option>
            @endforeach
          </select>
        </div>

        <!-- الخدمات المقدمة -->
        <div class="col-md-6">
          <label class="form-label">الخدمات المقدمة</label>
          <select class="form-select select2" name="provided_services[]" multiple required>
            @foreach ($provided_services as $service)
              <option value="{{ $service->id }}">{{ $service->name }}</option>
            @endforeach
          </select>
        </div>

        <!-- مجالات العمل -->
        <div class="col-md-6">
          <label class="form-label">مجالات العمل</label>
          <select class="form-select select2" name="work_fields[]" multiple required>
            @foreach ($work_fields as $field)
              <option value="{{ $field->id }}">{{ $field->name }}</option>
            @endforeach
          </select>
        </div>

        <!-- أهم المواضيع -->
        <div class="col-md-6">
          <label class="form-label">أهم المواضيع</label>
          <input id="important_topics" name="important_topics" class="form-control" placeholder="اكتب موضوعاً واضغط Enter" required>
        </div>

        <!-- الخبرات الدولية -->
        <div class="col-md-12">
            <label class="form-label">الخبرات الدولية</label>
            <select name="international_exp[]" class="form-select select2" multiple required>
              @foreach ($countries as $country)
                <option value="{{ $country->id }}">{{ $country->name }}</option>
              @endforeach
            </select>
          </div>

      <div class="text-center mt-4">
        <button type="submit" class="btn btn-primary px-5">حفظ التعديل</button>
      </div>
    </form>
  </div>
</div>

<!-- JS Libraries -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>

<script>
  $(document).ready(function() {
    $('.select2').select2({ width: '100%' });
  });

  const input = document.querySelector('#important_topics');
  new Tagify(input, {
    transformTag: function(tagData) {
      tagData.style = "--tag-bg:#0d6efd; --tag-text-color:white";
    }
  });
</script>

</body>
</html>
