<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>الأهداف ومحتوى التدريب</title>
    <style>
        body { font-family: 'Tahoma', sans-serif; direction: rtl; background: #f0f2f5; padding: 40px; }
        form { background: #fff; padding: 25px; border-radius: 8px; max-width: 800px; margin: auto; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        label { font-weight: bold; display: block; margin-top: 20px; }
        input[type="text"] { width: 100%; margin-top: 5px; margin-bottom: 10px; padding: 8px; border: 1px solid #ccc; border-radius: 4px; }
        .group { margin-bottom: 20px; }
        button.add-btn { background: #4299e1; color: white; padding: 6px 12px; border: none; border-radius: 4px; cursor: pointer; margin-top: 5px; }
        button.add-btn:hover { background: #2b6cb0; }
        button[type="submit"] { background: #38a169; color: white; padding: 10px 24px; border: none; border-radius: 4px; cursor: pointer; margin-top: 20px; }
        button[type="submit"]:hover { background-color: #2f855a; }
    </style>
</head>
<body>

    <form method="POST" action="{{ route('trainingGoals.store') }}">
        @csrf

        <!-- Learning Outcomes (Minimum 4 inputs) -->
        <div class="group" id="learning-group">
            <label>ما الذي سيتعلمه المشاركون؟ (يجب إدخال 4 على الأقل)</label>
            @for($i = 0; $i < 4; $i++)
                <input type="text" name="learning_outcomes[]" required>
            @endfor
        </div>
        <button type="button" class="add-btn" onclick="addField('learning-group', 'learning_outcomes[]')">إضافة هدف آخر</button>

        <!-- Requirements -->
        <div class="group" id="requirements-group">
            <label>ما هي الشروط أو المتطلبات؟</label>
            <input type="text" name="requirements[]" required>
        </div>
        <button type="button" class="add-btn" onclick="addField('requirements-group', 'requirements[]')">إضافة شرط آخر</button>

        <!-- Target Audience -->
        <div class="group" id="audience-group">
            <label>من هو الجمهور المستهدف؟</label>
            <input type="text" name="target_audience[]" required>
        </div>
        <button type="button" class="add-btn" onclick="addField('audience-group', 'target_audience[]')">إضافة جمهور آخر</button>

        <!-- Benefits -->
        <div class="group" id="benefits-group">
            <label>ما هي فوائد التدريب؟</label>
            <input type="text" name="benefits[]" required>
        </div>
        <button type="button" class="add-btn" onclick="addField('benefits-group', 'benefits[]')">إضافة فائدة أخرى</button>

        <button type="submit">التالي</button>
    </form>

    <script>
        function addField(groupId, nameAttr) {
            const container = document.getElementById(groupId);
            const input = document.createElement('input');
            input.type = 'text';
            input.name = nameAttr;
            input.required = true;
            container.appendChild(input);
        }
    </script>

</body>
</html>
