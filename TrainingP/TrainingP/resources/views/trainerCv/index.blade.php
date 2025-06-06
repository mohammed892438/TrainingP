<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your CV</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container">
        <h1>Your CV</h1>
        @if ($cv)
            <p><strong>Uploaded CV:</strong></p>
            <!-- <a href="{{ Storage::url($cv->cvFile) }}" target="_blank">Download CV</a> -->
            <form action="{{ route('trainerCv.destroy', $cv->id ) }}" method="POST" style="margin-top: 20px;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete CV</button>
            </form>
            <a href="{{ route('trainerCv.edit', $cv->id) }}" class="btn btn-secondary">Update CV</a>
        @else
            <p>No CV found. Please upload one.</p>
            <a href="{{ route('trainerCv.create') }}" class="btn btn-primary">Upload CV</a>
        @endif

        {{-- @if ($msg)
            <div class="alert alert-success mt-3">{{ $msg }}</div>
        @endif --}}
    </div>
</body>
</html>