<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>إضافة برنامج</title>
    <style>
        body { font-family: 'Arial', sans-serif; background: #f3f5f7; padding: 30px; direction: rtl; }
        form { background: #fff; padding: 20px 30px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); max-width: 700px; margin: auto; }
        label { font-weight: bold; margin-top: 15px; display: block; }
        input, textarea, select { width: 100%; padding: 10px; margin-top: 8px; border: 1px solid #ccc; border-radius: 4px; }
        button { background-color: #38a169; color: white; border: none; padding: 10px 20px; margin-top: 20px; border-radius: 4px; cursor: pointer; }
        button:hover { background-color: #2f855a; }
    </style>
</head>
<body>

    <form action="{{ route('BasicTrainingInformation.store') }}" method="POST">
        @csrf

        <label for="title">عنوان البرنامج</label>
        <textarea name="title" id="title" required>{{ old('title') }}</textarea>

        <label for="description">الوصف (اختياري)</label>
        <input type="text" name="description" id="description" value="{{ old('description') }}">

        <label for="program_type_id">نوع البرنامج</label>
        <select name="program_type_id" required>
            <option value="">-- اختر --</option>
            @foreach($types as $type)
                <option value="{{ $type->id }}">{{ $type->name }}</option>
            @endforeach
        </select>

        <label for="language_type_id">اللغة</label>
        <select name="language_type_id" required>
            <option value="">-- اختر --</option>
            @foreach($languages as $lang)
                <option value="{{ $lang->id }}">{{ $lang->name }}</option>
            @endforeach
        </select>

        <label for="training_classification_id">تصنيف التدريب</label>
        <select name="training_classification_id" required>
            <option value="">-- اختر --</option>
            @foreach($classifications as $classification)
                <option value="{{ $classification->id }}">{{ $classification->name }}</option>
            @endforeach
        </select>

        <label for="training_level_id">مستوى التدريب</label>
        <select name="training_level_id" required>
            <option value="">-- اختر --</option>
            @foreach($levels as $level)
                <option value="{{ $level->id }}">{{ $level->name }}</option>
            @endforeach
        </select>

        <label for="program_presentation_method_id">طريقة العرض</label>
        <select name="program_presentation_method_id" required>
            <option value="">-- اختر --</option>
            @foreach($presentationMethods as $method)
                <option value="{{ $method->id }}">{{ $method->name }}</option>
            @endforeach
        </select>

        <button type="submit">التالي</button>
    </form>

</body>
</html>
