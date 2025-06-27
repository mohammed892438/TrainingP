<!DOCTYPE html>
<html lang="ar">
<head>
  <meta charset="UTF-8">
  <title>الإعدادات الإضافية</title>
  <style>
    body {
      font-family: Tahoma;
      direction: rtl;
      background: #f2f4f7;
      padding: 40px;
    }
    form {
      background: white;
      padding: 25px;
      border-radius: 8px;
      max-width: 800px;
      margin: auto;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    label {
      font-weight: bold;
      margin-top: 15px;
      display: block;
    }
    input, select, textarea {
      width: 100%;
      margin-top: 5px;
      padding: 8px;
      border-radius: 4px;
      border: 1px solid #ccc;
    }
    .form-section {
      margin-bottom: 20px;
    }
    .add-btn {
      background-color: #4299e1;
      color: white;
      padding: 6px 12px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      margin-top: 10px;
    }
    .add-btn:hover {
      background-color: #2b6cb0;
    }
    button[type="submit"] {
      background-color: #38a169;
      color: white;
      padding: 10px 25px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      margin-top: 20px;
    }
  </style>
</head>
<body>

@if(session('success'))
  <p style="color: green;">{{ session('success') }}</p>
@endif
@if ($errors->any())
  <div style="background-color:#ffe0e0; color:#b30000; padding:15px; border-radius:6px; margin-bottom:20px;">
    <strong>حدثت الأخطاء التالية:</strong>
    <ul style="margin-top:10px;">
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif


<form method="POST" action="{{ route('additional_settings.store') }}" enctype="multipart/form-data">
  @csrf


  <div class="form-section">
    <label><input type="checkbox" name="is_free" value="1"> تدريب مجاني</label>
  </div>

  <div class="form-section">
    <label>التكلفة</label>
    <input type="number" step="0.01" name="cost">
    <label>العملة</label>
    <input type="text" name="currency">
    <label>طريقة الدفع</label>
    <input type="text" name="payment_method">
  </div>

  <div class="form-section">
    <label>الدولة</label>
    <select name="country_id">
      <option value="">اختر الدولة (اختياري)</option>
      @foreach ($countries as $country)
        <option value="{{ $country->id }}">{{ $country->name }}</option>
      @endforeach
    </select>

    <label>المدينة</label>
    <input type="text" name="city">

    <label>العنوان التفصيلي</label>
    <textarea name="residential_address" rows="2"></textarea>
  </div>

  <div class="form-section">
    <label>آخر موعد للتقديم</label>
    <input type="date" name="application_deadline" required>

    <label>أقصى عدد للمتدربين</label>
    <input type="number" name="max_trainees" required>

    <label>طريقة استقبال الطلبات</label>
    <select name="application_submission_method" required>
      <option value="inside_platform">داخل المنصة</option>
      <option value="outside_platform">خارج المنصة</option>
    </select>

    <label>رابط التسجيل (اختياري)</label>
    <input type="url" name="registration_link">
  </div>

  <div class="form-section">
    <label>الصورة التعريفية للبرنامج</label>
    <input type="file" name="profile_image" accept="image/*">
  </div>

  <div class="form-section">
    <label>ملفات التدريب</label>
    <div id="files-container">
      <input type="file" name="training_files[]" class="file-input">
    </div>
    <button type="button" class="add-btn" onclick="addFileInput()">إضافة ملف آخر</button>
  </div>

  <button type="submit"> التالي</button>
</form>

<script>
  function addFileInput() {
    const container = document.getElementById('files-container');
    const input = document.createElement('input');
    input.type = 'file';
    input.name = 'training_files[]';
    input.className = 'file-input';
    container.appendChild(input);
  }
</script>

</body>
</html>
