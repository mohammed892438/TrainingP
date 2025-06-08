
    <h1>الالتزامات</h1>
    <a href="{{ route('commitments.create') }}" class="btn">إضافة التزام جديد</a>

    @if(session('success'))
        <div class="alert success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert error">
            @foreach($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <table class="commitment-table">
        <thead>
            <tr>
                <th>الاسم</th>
                <th>جهة الالتزام</th>
                <th>العمليات</th>
            </tr>
        </thead>
        <tbody>
            @foreach($commitments as $commitment)
                <tr>
                    <td>{{ $commitment->name }}</td>
                    <td>{{ $commitment->committed_to }}</td>
                    <td>
                        <a href="{{ route('commitments.edit', $commitment) }}" class="btn edit">تعديل</a>
                        <form action="{{ route('commitments.destroy', $commitment) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn delete">حذف</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <style>
        .commitment-table {
            width: 100%;
            border-collapse: collapse;
        }
        .commitment-table th, .commitment-table td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        .commitment-table th {
            background-color: #f2f2f2;
        }
        .btn {
            background-color: #4CAF50; /* Green */
            color: white;
            padding: 10px 15px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn.edit {
            background-color: #2196F3; /* Blue */
        }
        .btn.delete {
            background-color: #f44336; /* Red */
        }
        .alert {
            margin: 15px 0;
            padding: 10px;
            border-radius: 5px;
        }
        .alert.success {
            background-color: #dff0d8;
            color: #3c763d;
        }
        .alert.error {
            background-color: #f2dede;
            color: #a94442;
        }
    </style>
