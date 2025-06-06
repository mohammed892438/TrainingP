<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Certificates</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>User Certificates</h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Certificate Name</th>
                    <th>Issuer</th>
                    <th>Issue Date</th>
                    <th>Verification Link</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($userCertificates as $certificate)
                    <tr>
                        <td>{{ $certificate->certificate->name }}</td>
                        <td>{{ $certificate->certificate->issuer }}</td>
                        <td>{{ $certificate->issue_date }}</td>
                        <td><a href="{{ $certificate->verification_link }}" target="_blank">Verify</a></td>
                        <td>
                            <a href="{{ route('user_certificate.update.form', $certificate->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('user_certificate.delete', $certificate->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <a href="{{ route('user_certificate.store.form') }}" class="btn btn-primary">Add New Certificate</a>
    </div>
</body>
</html>
