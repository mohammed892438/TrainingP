<!DOCTYPE html>
<html lang="ar">
<head>
  <meta charset="UTF-8">
  <title>جدولة جلسات التدريب</title>
  <style>
    body { font-family: Tahoma; direction: rtl; background: #f4f6f8; padding: 40px; }
    form { background: white; padding: 25px; border-radius: 8px; max-width: 700px; margin: auto; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
    label { font-weight: bold; display: block; margin-top: 15px; }
    input, select { width: 100%; margin-top: 5px; padding: 8px; border-radius: 4px; border: 1px solid #ccc; }
    .entry { border: 1px solid #eee; padding: 15px; margin-top: 20px; border-radius: 5px; }
    .add-btn { background-color: #4299e1; color: white; padding: 6px 12px; border: none; border-radius: 4px; cursor: pointer; margin-top: 10px; }
    button[type="submit"] { background-color: #38a169; color: white; padding: 10px 25px; border: none; border-radius: 4px; margin-top: 20px; }
  </style>
</head>
<body>

<form method="POST" action="{{ route('scheduling_training_sessions.store') }}">
  @csrf


  <div id="schedule-container">
    <div class="entry">
      <label>تاريخ الجلسة</label>
      <input type="date" name="schedules[0][session_date]" required>

      <label>مدة الجلسة (بالدقائق)</label>
      <input type="number" name="schedules[0][duration_minutes]" min="1" required>
    </div>
  </div>

  <button type="button" class="add-btn" onclick="addSchedule()">إضافة جلسة أخرى</button>
  <button type="submit"> التالي</button>
</form>

<script>
  let index = 1;

  function addSchedule() {
    const container = document.getElementById('schedule-container');
    const div = document.createElement('div');
    div.className = 'entry';
    div.innerHTML = `
      <label>تاريخ الجلسة</label>
      <input type="date" name="schedules[${index}][session_date]" required>

      <label>مدة الجلسة (بالدقائق)</label>
      <input type="number" name="schedules[${index}][duration_minutes]" min="1" required>
    `;
    container.appendChild(div);
    index++;
  }
</script>

</body>
</html>
