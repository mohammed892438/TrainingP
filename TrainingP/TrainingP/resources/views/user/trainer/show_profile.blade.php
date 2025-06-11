<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Trainer Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <!-- User Information -->
        <div class="card mb-3">
            <div class="card-header">
                <h3>معلومات التواصل</h3>
            </div>
            <div class="card-body">
                <p><strong>Name:</strong> {{ $user->name }}</p>
                <p><strong>Email:</strong> {{ $user->email }}</p>
                <p><strong>Phone:</strong> {{ $user->phone_number }}</p>
                <p><strong>Bio:</strong> {{ $user->bio }}</p>
                <p><strong>City:</strong> {{ $user->city }}</p>
                <p><strong>Country:</strong> {{ $user->country->name }}</p>

            </div>
        </div>

         <!-- summury  -->
         <div class="card mb-3">
            <div class="card-header">
                <h3 >ملخص الخبرات  </h3>
            </div>
            <div class="card-body">
                <ul>
                    <strong>provided services:</strong>
                        <ul>
                            @foreach ($providedServices as $service)
                                <li>{{ $service->name }}</li>
                            @endforeach
                        </ul>
                    <strong>work sectors:</strong>
                        <ul>
                            @foreach ($workSectors as $workSector)
                                <li>{{ $workSector->name }}</li>
                            @endforeach
                        </ul>
                    <strong> important topics:</strong>
                        <ul>
                            @foreach ($importantTopics as $topic)
                                <li>{{ $topic }}</li>
                            @endforeach
                        </ul>
                </ul>
            </div>
        </div>

        <!-- Trainer Information -->
        <div class="card mb-3">
            <div class="card-header">
                <h3>Trainer Details</h3>
            </div>
            <div class="card-body">
                <p><strong>Headline:</strong> {{ $trainer->headline }}</p>
                <p><strong>Status:</strong> {{ $trainer->status }}</p>

                <p><strong>Hourly Wage:</strong> {{ $trainer->hourly_wage }}</p>
            </div>
        </div>

        <!-- work experence  -->
        <div class="card mb-3">
            <div class="card-header">
                <h3>الخبرات العملية</h3>
            </div>
            <div class="card-body">
                <ul>
                    @foreach ($workexperiences as $experience)
                        <li>
                            <strong>Job Title:</strong> {{ $experience->title ?? 'N/A' }}<br>
                            <strong>the authority:</strong> {{ $experience->the_authority ?? 'N/A' }}<br>
                            <strong>Start Date:</strong> {{ $experience->start_date ?? 'N/A' }}<br>
                            <strong>End Date:</strong> {{ $experience->end_date ?? 'مستمر' }}
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

         <!-- Education  -->
         <div class="card mb-3">
            <div class="card-header">
                <h3>التعليم</h3>
            </div>
            <div class="card-body">
                <ul>
                    @foreach ($educations as $education)
                        <li>
                            <strong>specialization:</strong> {{ $education->specialization ?? 'N/A' }}<br>
                            <strong>university:</strong> {{ $education->university ?? 'N/A' }}<br>
                            <strong>graduation year:</strong> {{ $education->graduation_year ?? 'مستمر' }}<br>
                            <strong>education level :</strong> {{ ($education->educationLevel)->name ?? 'N/A' }}
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <!-- Certificates  -->
        <div class="card mb-3">
            <div class="card-header">
                <h3>الشهادات الاحترافية </h3>
            </div>
            <div class="card-body">
                <ul>
                    @foreach ($Certificates as $Certificate)
                        <li>
                            <strong>name:</strong> {{ $Certificate->certificate->name ?? 'N/A' }}<br>
                            <strong>issuer:</strong> {{ $Certificate->certificate->issuer ?? 'N/A' }}<br>
                            <strong>issue_date:</strong> {{ $Certificate->issue_date ?? 'N/A' }}<br>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>


         <!-- volunteerings  -->
         <div class="card mb-3">
            <div class="card-header">
                <h3> التطوع </h3>
            </div>
            <div class="card-body">
                <ul>
                    @foreach ($volunteerings as $volunteering)
                        <li>
                            <strong>type:</strong> {{  $volunteering->serviceType->name  ?? 'N/A' }}<br>
                            <strong>mounthly_hours:</strong> {{ $volunteering->mounthly_hours ?? 'N/A' }}<br>
                            <strong>training titles:</strong>
                            <ul>
                                @foreach($volunteering->training_titles as $title)
                                    <li>{{ $title }}</li>
                                @endforeach
                            </ul>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

         <!-- trainingexperiences  -->
         <div class="card mb-3">
            <div class="card-header">
                <h3> الخبرات التدريبية  </h3>
            </div>
            <div class="card-body">
                <ul>
                    @foreach ($trainingexperiences as $trainingexperience)
                        <li>
                            <strong>title:</strong> {{ $trainingexperience->title_id ? $trainingexperience->title->name : 'N/A' }}<br>
                             <strong>country:</strong> {{ $trainingexperience->country_id ? $trainingexperience->country->name : 'N/A' }}<br>
                             <strong>authority:</strong> {{ $trainingexperience->authority }}<br>
                             <strong>engagement_type:</strong> {{ $trainingexperience->engagement_type }}<br>
                             <strong>trainees_number:</strong> {{ $trainingexperience->trainees_number }}<br>
                             <strong>trainees_type:</strong> {{ $trainingexperience->trainees_type }}<br>
                             <strong>hours_number:</strong> {{ $trainingexperience->hours_number }}<br>
                             <strong>description:</strong> {{ $trainingexperience->description }}<br>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

         <!-- protfolios  -->
         <div class="card mb-3">
            <div class="card-header">
                <h3> محفظة الاعمال </h3>
            </div>
            <div class="card-body">
                <ul>
                    @foreach($Portfolios as $portfolio)
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card h-100 shadow-sm">
                            @if($portfolio->photo)
                            <img src="{{ asset('storage/' . $portfolio->photo) }}" alt="صورة العمل" class="card-img-top">
                            @endif
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">{{ $portfolio->title }}</h5>

                                @php
                                    $isUrl = filter_var($portfolio->file, FILTER_VALIDATE_URL);
                                @endphp

                                @if($isUrl)
                                    <a href="{{ $portfolio->file }}" target="_blank" class="btn btn-outline-primary btn-sm mt-auto">عرض الرابط</a>
                                @else
                                    <a href="{{ asset('storage/' . $portfolio->file) }}" class="btn btn-outline-info btn-sm mt-auto" download>تحميل الملف</a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
                </ul>
            </div>
        </div>

        <!-- services  -->
        <div class="card mb-3">
            <div class="card-header">
                <h3> الخدمات </h3>
            </div>
            <div class="card-body">
                <ul>
                    @foreach ($services as $service)
                        <li>
                            <strong>title:</strong>{{ $service->title }}<br>
                            <strong>description:</strong>{{ Str::limit($service->description, 50) }}<br>
                            <strong>training_areas:</strong>{{ is_array($service->training_areas) ? implode(', ', $service->training_areas) : $service->training_areas }}<br>
                            <strong>client_type:</strong>{{ $service->client_type }}<br>
                            <strong>client_level:</strong>{{ $service->client_level }}<br>
                            <strong>application_method:</strong>{{ $service->application_method }}<br>
                            <strong>hourly_wage:</strong>${{ number_format($service->hourly_wage, 2) }}<br>
                            <strong>title:</strong>{{ $service->workExperience?->title ?? 'غير محددة' }}<br>
                            <strong>added_value:</strong>{{ Str::limit($service->added_value, 50) }}<br>
                            <strong>notes:</strong>{{ Str::limit($service->notes) }}<br>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <!-- skills  -->
        <div class="card mb-3">
            <div class="card-header">
                <h3 >المهارات </h3>
            </div>
            <div class="card-body">
                <ul>
                    @foreach ($skills as $skill)
                        <li>
                            <strong>skill:</strong> {{ $skill->name ?? 'N/A' }}<br>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>




    </div>







    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
