@php
  use Illuminate\Support\Facades\Auth;
  $user = Auth::user();
@endphp

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <title>معلومات التواصل</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Styles -->
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

    .flag-img {
      width: 20px;
      height: 14px;
    }

    .dropdown-arrow {
      font-size: 0.8rem;
      margin-left: 5px;
    }

    .flag-options {
      position: absolute;
      top: 100%;
      right: 0;
      width: 200px;
      background-color: #fff;
      border: 1px solid #ccc;
      z-index: 1000;
      display: none;
      flex-direction: column;
      max-height: 200px;
      overflow-y: auto;
    }

    .flag-item {
      display: flex;
      align-items: center;
      padding: 5px 10px;
      cursor: pointer;
    }

    .flag-item:hover {
      background-color: #f0f0f0;
    }

    .divider-line {
      width: 1px;
      height: 25px;
      background-color: #ccc;
      margin: 0 10px;
    }

    .code-box {
      min-width: 60px;
      text-align: center;
    }

    .phone-input {
      direction: ltr;
    }

    .search-box {
      border: none;
      border-bottom: 1px solid #ccc;
      padding: 5px 10px;
      width: 100%;
      box-sizing: border-box;
    }
  </style>
</head>
<body>

<div class="container">
  <div class="form-section">
    <h4 class="text-center mb-4">معلومات التواصل</h4>

    @if ($errors->any())
      <div class="alert alert-danger">
        <ul class="mb-0">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form method="POST" action="{{ route('update_contact_info', $user->id) }}">
      @csrf
      @method('PUT')

      <div class="row g-3">
        <!-- البريد الإلكتروني -->
        <div class="col-md-6">
          <label class="form-label">البريد الإلكتروني</label>
          <input type="email" class="form-control" value="{{ $user->email }}" disabled>
        </div>

        <!-- رقم الهاتف -->
        <div class="col-md-6">
          <label class="form-label">رقم الهاتف</label>
          <div class="form-control p-0" dir="ltr">
            <div class="d-flex align-items-center w-100 ps-3 pe-3 gap-2" style="min-height: 48px;" id="phoneWrapper">
              <!-- قائمة الدول -->
              <div class="dropdown position-relative" id="flagDropdown" dir="rtl">
                <div class="selected-flag d-flex align-items-center gap-1">
                  <span class="dropdown-arrow">🞃</span>
                  <img src="{{ asset('flags/tr.svg') }}" id="selectedFlag" class="flag-img" alt="flag">
                </div>
                <div class="flag-options" id="flagOptions">
                  <input type="text" id="searchBox" class="search-box" placeholder="اكتب رمز الدولة...">
                  @foreach ($countries as $country)
                    <div class="flag-item" data-code="{{ $country->phone_code }}" data-iso="{{ strtolower($country->iso2) }}">
                      <img src="{{ asset('flags/' . strtolower($country->iso2) . '.svg') }}" class="flag-img">
                      <span class="flag-code">+{{ $country->phone_code }}</span>
                    </div>
                  @endforeach
                </div>
              </div>

              <div class="divider-line"></div>
              <div class="code-box" id="phoneCode" dir="ltr">+90</div>
              <input type="text" id="phone_number" name="phone_number" required
                     class="flex-grow-1 border-0 ps-2 phone-input"
                     pattern="[0-9]{6,15}" title="يجب أن يحتوي على أرقام فقط (6-15 رقم)">
            </div>
          </div>
        </div>

        <!-- الدولة -->
        <div class="col-md-6">
          <label class="form-label">الدولة</label>
          <select id="country_id" name="country_id" class="form-select" required>
            <option value="" selected disabled>اختر الدولة التي تقيم بها</option>
            @foreach ($countries as $country)
              <option value="{{ $country->id }}">{{ $country->name }}</option>
            @endforeach
          </select>
        </div>

        <!-- المدينة -->
        <div class="col-md-6">
          <label class="form-label">المدينة</label>
          <select id="city" name="city" class="form-select" required>
            <option value="" selected disabled>اختر المدينة</option>
          </select>
        </div>

        <!-- الموقع الإلكتروني -->
        <div class="col-md-12">
          <label class="form-label">الموقع الإلكتروني</label>
          <input type="url" name="website" class="form-control" placeholder="اكتب هنا">
        </div>
      </div>

      <div class="text-center mt-4">
        <button type="submit" class="btn btn-primary px-5">
          ← حفظ التعديل
        </button>
      </div>
    </form>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
  // تبديل العلم ورمز الدولة
  const dropdown = document.getElementById("flagDropdown");
  const flagOptions = document.getElementById("flagOptions");
  const selectedFlag = document.getElementById("selectedFlag");
  const phoneCode = document.getElementById("phoneCode");

  dropdown.addEventListener("click", (e) => {
    flagOptions.style.display = flagOptions.style.display === "flex" ? "none" : "flex";
    e.stopPropagation();
  });

  document.querySelectorAll(".flag-item").forEach(item => {
    item.addEventListener("click", () => {
      const iso = item.getAttribute("data-iso");
      const code = item.getAttribute("data-code");
      selectedFlag.src = `/flags/${iso}.svg`;
      phoneCode.textContent = `+${code}`;
      flagOptions.style.display = "none";
    });
  });

  document.addEventListener("click", (e) => {
    if (!dropdown.contains(e.target)) {
      flagOptions.style.display = "none";
    }
  });

  document.getElementById("searchBox").addEventListener("input", function () {
    const value = this.value.trim();
    document.querySelectorAll(".flag-item").forEach(item => {
      const code = item.getAttribute("data-code");
      item.style.display = code.startsWith(value) ? "flex" : "none";
    });
  });

  // تحميل المدن تلقائياً حسب الدولة
  $('#country_id').on('change', function () {
    const selectedCountry = $(this).val();
    $('#city').empty().append('<option value="" selected disabled>اختر المدينة</option>');

    fetch('/cities') // تأكد أن هذا المسار يرجع قائمة المدن
      .then(res => res.json())
      .then(data => {
        const filtered = data.filter(city => city.country_id == selectedCountry);
        filtered.forEach(city => {
          $('#city').append(`<option value="${city.name}">${city.name}</option>`);
        });
      });
  });

  // دمج رمز الدولة مع رقم الهاتف قبل الإرسال
  document.querySelector('form').addEventListener('submit', function () {
    const code = document.getElementById('phoneCode').textContent.trim();
    const number = document.getElementById('phone_number').value.trim();
    document.getElementById('phone_number').value = code + number;
  });
</script>

</body>
</html>
