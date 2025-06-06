<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">Laravel App</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container text-center mt-5">
        <h1>Welcome to Laravel</h1>
        <p>This is a simple home page built with Laravel Blade.</p>
        @if(Auth::check())
            <p>Hello, {{ Auth::user()->name }}!</p>
            <a href="{{ route('logout') }}" class="btn btn-danger">Logout</a>
        @else
            <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
        @endif

        <div class="mt-4">
            <a href="{{ route('trainerCv.index') }}" class="btn btn-secondary">View Your CV</a>
            @if ($cv)
                <a href="{{ route('trainerCv.update', $cv->id) }}" class="btn btn-success">Update CV</a>
            @else
                <a href="{{ route('trainerCv.create') }}" class="btn btn-primary">Upload CV</a>
            @endif
            <a href="{{ route('trainingExperience.index') }}" class="btn btn-info">Manage Training Experience</a>
            <a href="{{ route('workExperience.index') }}" class="btn btn-info">View Work Experiences</a>
            <a href="{{ route('education.index') }}" class="btn btn-info">Educations management</a>
            <a href="{{ route('userCertificates.index') }}" class="btn btn-info">Certificates management</a>
            <a href="{{ route('portfolio.index') }}" class="btn btn-info">portfolio management</a>
            <a href="{{ route('skills.index') }}" class="btn btn-info">skills</a>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
