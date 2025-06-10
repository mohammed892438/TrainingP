<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ملف المؤسسة</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 900px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }
        h2, h3 {
            color: #333;
            border-bottom: 2px solid #4CAF50;
            padding-bottom: 10px;
        }
        p {
            line-height: 1.6;
            color: #555;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            background: #e9e9e9;
            margin: 5px 0;
            padding: 15px;
            border-radius: 5px;
            transition: background 0.3s;
        }
        li:hover {
            background: #d4d4d4;
        }
        .info {
            padding: 15px;
            background-color: #e0f7fa;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .info strong {
            color: #00796b;
        }
        .section {
            margin-bottom: 30px;
        }
        .footer {
            text-align: center;
            padding: 20px;
            margin-top: 20px;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>حول المؤسسة</h2>
        <div class="info">
            <p><strong>اسم المؤسسة:</strong> {{ $user->name }}</p>
            <p><strong>معلومات موقع الاكلتروني:</strong> {{ $organization->website }}</p>
            <p><strong>البريد الإلكتروني:</strong> {{ $user->email }}</p>
            <p><strong>رقم الهاتف:</strong> {{ $user->phone_number }}</p>
            <p><strong>العنوان:</strong> {{ $user->city }}</p>
            <p><strong>عدد الموظفين</strong>{{ $organization->employee_numbers_id }}</p>
            <p><strong>تاريخ النشأة</strong>{{ $organization->established_year }}</p>
            <p><strong>الميزانية السنوية ID:</strong> {{ $organization->annualBudget->name }}</p>
            <p><strong>البلد</strong> {{ $user->country->name }}</p>
            <p><strong>نوع الشركة</strong> {{ $organization->type->name }}</p>
            <p><strong>الفروع:</strong> 
                @if (!empty($organization->branches) && is_array($organization->branches))
                    {{ implode(', ', $organization->branches) }}
                @else
                    لا توجد فروع متاحة
                @endif
            </p>
            <p><strong>قطاعات المؤسسة:</strong> 
                @if (!empty($organization->organization_sectors) && is_array($organization->organization_sectors))
                    {{ implode(', ', $organization->organization_sectors) }}
                @else
                    لا توجد قطاعات مسجلة
                @endif
            </p>
            <p><strong>نوع العمل:</strong> {{ $organization->work_type ?: 'لا يوجد نوع عمل محدد' }}</p>
            <p><strong>نبذة عن المؤسسة:</strong> 
                {{ $user->bio ?: 'لا توجد معلومات متاحة عن المؤسسة.' }}
            </p>

            <p><strong>صورة المؤسسة:</strong></p>
            @if ($user->photo)
                <img src="{{ asset($user->photo) }}" alt="صورة المؤسسة" style="max-width: 100%; height: auto;">
            @else
                <p>لا توجد صورة متاحة.</p>
            @endif
        </div>

        <h2>التحديات والمشاكل</h2>
        <div class="challenges">
            @if ($challenges && $challenges->isNotEmpty())
                <ul>
                    @foreach ($challenges as $challenge)
                        <li>{{ $challenge->name }}</li>
                    @endforeach
                </ul>
            @else
                <p>لا توجد تحديات أو مشاكل مسجلة.</p>
            @endif
        </div>

        <h2>الالتزامات</h2>
        <div class="commitments">
            @if ($commitments && $commitments->isNotEmpty())
                <ul>
                    @foreach ($commitments as $commitment)
                        <li>
                            <strong>اسم الالتزام:</strong> {{ $commitment->name }}<br>
                            <strong>مخصص لـ:</strong> {{ $commitment->committed_to }}
                        </li>
                    @endforeach
                </ul>
            @else
                <p>لا توجد التزامات مسجلة.</p>
            @endif
        </div>

        <h2>الأهداف</h2>
        <div class="goals">
            @if ($goals && $goals->isNotEmpty())
                <ul>
                    @foreach ($goals as $goal)
                        <li>{{ $goal->name }}</li> <!-- Access the name attribute -->
                    @endforeach
                </ul>
            @else
                <p>لا توجد أهداف مسجلة.</p>
            @endif
        </div>

        <h2>التعاونيات</h2>
        <div class="collaborations">
            @if ($collaborations && $collaborations->isNotEmpty())
                <ul>
                    @foreach ($collaborations as $collaboration)
                        <li>
                            <strong>اسم المؤسسة:</strong> {{ Auth::user()->name  }}<br>
                            <strong>رقم الشركة:</strong> {{ $collaboration->coporation->name }}
                        </li>
                    @endforeach
                </ul>
            @else
                <p>لا توجد تعاونيات مسجلة.</p>
            @endif
        </div>

    <div class="footer">
        <p>حقوق الطبع والنشر &copy; 2023. جميع الحقوق محفوظة.</p>
    </div>
</body>
</html>