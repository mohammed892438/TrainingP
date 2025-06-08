
    <h1>تعديل الالتزام</h1>

    <form action="{{ route('commitments.update', $commitment) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">اسم الالتزام:</label>
            <input type="text" name="name" id="name" value="{{ $commitment->name }}" required>
        </div>
        <div class="form-group">
            <label for="committed_to">جهة الالتزام:</label>
            <select name="committed_to" id="committed_to" required>
                @foreach(App\Enums\CommittedToEnum::cases() as $option)
                    <option value="{{ $option->value }}" {{ $commitment->committed_to == $option->value ? 'selected' : '' }}>
                        {{ $option->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn">تحديث</button>
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
