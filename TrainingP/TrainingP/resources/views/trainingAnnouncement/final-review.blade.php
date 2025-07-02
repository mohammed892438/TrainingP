<!DOCTYPE html>
<html lang="ar">
<head>
  <meta charset="UTF-8">
  <title>مراجعة البرنامج التدريبي</title>
  <style>
    body { font-family: Tahoma; direction: rtl; background-color: #f9fafa; padding: 40px; }
    .box { background: white; padding: 20px; margin-bottom: 30px; border-radius: 8px; box-shadow: 0 0 5px rgba(0,0,0,0.05); }
    h3 { margin-bottom: 15px; color: #2d3748; }
    p, li { margin: 5px 0; }
    img { max-width: 250px; margin-top: 10px; border-radius: 6px; }
    button { background-color: #38a169; color: white; padding: 10px 25px; border: none; border-radius: 5px; cursor: pointer; }
    a { color: #007bff; text-decoration: none; }
  </style>
</head>
<body>

  @if(session('success'))
    <div style="color: green;">{{ session('success') }}</div>
  @endif

  @if(session('error'))
    <div style="color: red;">{{ session('error') }}</div>
  @endif

  <form method="POST" action="{{ route('training.store.all') }}">
    @csrf

    {{-- معلومات البرنامج --}}
    <div class="box">
      <h3>📘 بيانات البرنامج التدريبي</h3>
      <p><strong>العنوان:</strong> {{ $step1['title'] ?? '---' }}</p>
      <p><strong>الوصف:</strong> {{ $step1['description'] ?? '---' }}</p>
      <p><strong>نوع البرنامج:</strong> {{ $step1['program_type_id'] ?? '---' }}</p>
      <p><strong>اللغة:</strong> {{ $step1['language_type_id'] ?? '---' }}</p>
      <p><strong>التصنيف:</strong> {{ $step1['training_classification_id'] ?? '---' }}</p>
      <p><strong>المستوى:</strong> {{ $step1['training_level_id'] ?? '---' }}</p>
      <p><strong>طريقة التقديم:</strong> {{ $step1['program_presentation_method_id'] ?? '---' }}</p>
    </div>

    @php
  $goal = $goals; // لأن $goals هو عنصر واحد فقط
  $outcomes = json_decode($goal['learning_outcomes'] ?? '[]', true);
  $requirements = json_decode($goal['requirements'] ?? '[]', true);
  $audience = json_decode($goal['target_audience'] ?? '[]', true);
  $benefits = json_decode($goal['benefits'] ?? '[]', true);
@endphp

<div class="box">
  <h3>🎯 الأهداف والمحتوى</h3>

  <strong>المخرجات:</strong>
  <ul>
    @foreach($outcomes as $item)
      <li>{{ $item }}</li>
    @endforeach
  </ul>

  <strong>المتطلبات:</strong>
  <ul>
    @foreach($requirements as $item)
      <li>{{ $item }}</li>
    @endforeach
  </ul>

  <strong>الفئة المستهدفة:</strong>
  <ul>
    @foreach($audience as $item)
      <li>{{ $item }}</li>
    @endforeach
  </ul>

  <strong>الفوائد:</strong>
  <ul>
    @foreach($benefits as $item)
      <li>{{ $item }}</li>
    @endforeach
  </ul>
</div>



    {{-- المدربون والمساعدون --}}
    <div class="box">
        <h3>👥 المدربون والمساعدون</h3>
        <p><strong>المدربون:</strong>
            {{ implode(', ', array_values($trainerNames ?? [])) }}
        </p>
        <p><strong>المساعدون:</strong>
            {{ implode(', ', array_values($assistantNames ?? [])) }}
        </p>
    </div>

    
    {{-- جلسات التدريب --}}
    <div class="box">
      <h3>⏰ جلسات التدريب</h3>
      @foreach($scheduling['schedules'] ?? [] as $s)
        <p>📅 {{ $s['session_date'] }} - {{ $s['duration_minutes'] }} دقيقة</p>
      @endforeach
    </div>

    {{-- الإعدادات الإضافية --}}
    <div class="box">
      <h3>⚙️ الإعدادات الإضافية</h3>
      <p><strong>مجاني:</strong> {{ isset($settings['is_free']) && $settings['is_free'] ? 'نعم' : 'لا' }}</p>
      <p><strong>التكلفة:</strong> {{ $settings['cost'] ?? '-' }} {{ $settings['currency'] ?? '' }}</p>
      <p><strong>طريقة الدفع:</strong> {{ $settings['payment_method'] ?? '-' }}</p>
      <p><strong>الدولة:</strong> {{ $settings['country_id'] ?? '-' }}</p>
      <p><strong>المدينة:</strong> {{ $settings['city'] ?? '-' }}</p>
      <p><strong>العنوان:</strong> {{ $settings['residential_address'] ?? '-' }}</p>
      <p><strong>آخر موعد للتقديم:</strong> {{ $settings['application_deadline'] ?? '-' }}</p>
      <p><strong>العدد الأقصى:</strong> {{ $settings['max_trainees'] ?? '-' }}</p>
      <p><strong>طريقة استقبال الطلبات:</strong> {{ $settings['application_submission_method'] ?? '-' }}</p>
      <p><strong>رابط التسجيل:</strong> 
        @if(!empty($settings['registration_link']))
          <a href="{{ $settings['registration_link'] }}" target="_blank">{{ $settings['registration_link'] }}</a>
        @else
          -
        @endif
      </p>

      @if(!empty($settings['profile_image']))
        <p><strong>الصورة التعريفية:</strong></p>
        <img src="{{ asset('storage/' . $settings['profile_image']) }}" alt="Profile Image">
      @endif

      @if(!empty($settings['training_files']))
        <p><strong>ملفات التدريب:</strong></p>
        <ul>
            @foreach($settings['training_files'] as $file)
                <li><a href="{{ asset('storage/' . $file) }}" target="_blank">{{ basename($file) }}</a></li>
            @endforeach
        </ul>
      @endif
    </div>

    <button type="submit">✅ تأكيد وحفظ البرنامج</button>
  </form>

</body>
</html>
