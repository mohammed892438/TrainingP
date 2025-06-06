<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User Certificate</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script>
        function updateIssuer() {
            const certificateSelect = document.getElementById("certificate_id");
            const issuerField = document.getElementById("issuer");

            const certificates = @json($certificates);

            const selectedCertificate = certificates.find(c => c.id == certificateSelect.value);
            issuerField.value = selectedCertificate ? selectedCertificate.issuer : '';
        }
    </script>
</head>
<body>
    <div class="container mt-5">
        <h1>Update User Certificate</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('user_certificate.update', $userCertificate->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="certificate_id" class="form-label">Certificate</label>
                <select class="form-select" id="certificate_id" name="certificate_id" onchange="updateIssuer()" required>
                    <option value="">Select Certificate</option>
                    @foreach ($certificates as $certificate)
                        <option value="{{ $certificate->id }}" {{ $userCertificate->certificate_id == $certificate->id ? 'selected' : '' }}>
                            {{ $certificate->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="issuer" class="form-label">Issuer</label>
                <input type="text" class="form-control" id="issuer" name="issuer" value="{{ $userCertificate->certificate->issuer }}" readonly>
            </div>

            <div class="mb-3">
                <label for="issue_date" class="form-label">Issue Date</label>
                <input type="date" class="form-control" id="issue_date" name="issue_date" value="{{ old('issue_date', $userCertificate->issue_date) }}" required>
            </div>

            <div class="mb-3">
                <label for="verification_link" class="form-label">Verification Link</label>
                <input type="url" class="form-control" id="verification_link" name="verification_link" value="{{ old('verification_link', $userCertificate->verification_link) }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</body>
</html>