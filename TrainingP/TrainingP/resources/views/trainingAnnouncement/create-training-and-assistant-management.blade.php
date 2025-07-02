<!DOCTYPE html>
<html lang="ar">
<head>
  <meta charset="UTF-8">
  <title>إدارة المدربين والمساعدين</title>
  <style>
    body { font-family: Tahoma; direction: rtl; padding: 40px; background: #f5f7f9; }
    form { background: #fff; padding: 25px; max-width: 700px; margin: auto; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.08); }
    label { font-weight: bold; display: block; margin-top: 15px; }
    select { width: 100%; margin-top: 5px; padding: 8px; border: 1px solid #ccc; border-radius: 4px; }
    .group { margin-bottom: 30px; }
    .entry { margin-top: 10px; }
    button.add-btn { background-color: #4299e1; color: #fff; padding: 6px 12px; border: none; border-radius: 4px; margin-top: 10px; cursor: pointer; }
    button.add-btn:hover { background-color: #2b6cb0; }
    button[type="submit"] { background-color: #38a169; color: white; padding: 10px 25px; border: none; border-radius: 5px; margin-top: 30px; cursor: pointer; }
    button[type="submit"]:hover { background-color: #2f855a; }
  </style>
</head>
<body>

<form method="POST" action="{{ route('training_assistant_management.store') }}">
  @csrf

  <!-- قسم المدربين -->
  <div class="group">
    <label>المدربون المشاركون:</label>
    <div id="trainer-container">
      <div class="entry">
        <select name="trainer_ids[]" required>
          @foreach ($users as $user)
            @if ($user->user_type_id == 1)
              <option value="{{ $user->id }}">{{ $user->name }} - {{ $user->email }}</option>
            @endif
          @endforeach
        </select>
      </div>
    </div>
    <button type="button" class="add-btn" onclick="addTrainer()">إضافة مدرب آخر</button>
  </div>

  <!-- قسم المساعدين -->
  <div class="group">
    <label>المساعدون:</label>
    <div id="assistant-container">
      <div class="entry">
        <select name="assistant_ids[]" required>
          @foreach ($users as $user)
            @if ($user->user_type_id == 2)
              <option value="{{ $user->id }}">{{ $user->name }} - {{ $user->email }}</option>
            @endif
          @endforeach
        </select>
      </div>
    </div>
    <button type="button" class="add-btn" onclick="addAssistant()">إضافة مساعد آخر</button>
  </div>

  <button type="submit"> التالي </button>
</form>

<script>
  function addTrainer() {
    const trainerContainer = document.getElementById('trainer-container');
    const div = document.createElement('div');
    div.classList.add('entry');
    div.innerHTML = `
      <select name="trainer_ids[]" required>
        @foreach ($users as $user)
          @if ($user->user_type_id == 1)
            <option value="{{ $user->id }}">{{ $user->name }} - {{ $user->email }}</option>
          @endif
        @endforeach
      </select>
    `;
    trainerContainer.appendChild(div);
  }

  function addAssistant() {
    const assistantContainer = document.getElementById('assistant-container');
    const div = document.createElement('div');
    div.classList.add('entry');
    div.innerHTML = `
      <select name="assistant_ids[]" required>
        @foreach ($users as $user)
          @if ($user->user_type_id == 2)
            <option value="{{ $user->id }}">{{ $user->name }} - {{ $user->email }}</option>
          @endif
        @endforeach
      </select>
    `;
    assistantContainer.appendChild(div);
  }
</script>

</body>
</html>
