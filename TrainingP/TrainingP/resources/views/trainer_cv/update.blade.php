<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Your CV</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container">
        <h1>Update Your CV</h1>
        <form action="{{ route('trainer.cv.update', $cv->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="uploadPdf">Upload New CV (PDF)</label>
                <input type="file" name="uploadPdf" id="uploadPdf" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
        <a href="{{ route('trainer.cv.get') }}" class="btn btn-secondary">Back to CV</a>
    </div>
</body>
</html>