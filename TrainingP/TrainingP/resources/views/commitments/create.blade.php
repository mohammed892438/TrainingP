
    <h1>إضافة التزام جديد</h1>

    <form action="{{ route('commitments.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">اسم الالتزام:</label>
            <input type="text" name="name" id="name" required>
        </div>
        <div class="form-group">
            <label for="committed_to">جهة الالتزام:</label>
            <select name="committed_to" id="committed_to" required>
                @foreach(App\Enums\CommittedToEnum::cases() as $option)
                    <option value="{{ $option->value }}">{{ $option->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn">حفظ</button>
    </form>

    @if($errors->any())
        <div class="alert error">
            @foreach($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    @if(session('success'))
        <div class="alert success">{{ session('success') }}</div>
    @endif


    <style>
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input, select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .btn {
            margin-top: 10px;
        }
    </style>
