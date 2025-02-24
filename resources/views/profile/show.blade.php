<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>البروفايل</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css">

</head>
<body>

</html>



@include('layouts.app')

   @include('layouts.sidebar')

   <div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="profile-card">
                <div class="text-center">
                    <!-- الصورة الشخصية -->
                    @if($user->profile_image)
                        <img src="{{ asset('storage/' . $user->profile_image) }}" alt="الصورة الشخصية" class="profile-image">
                    @else
                        <img src="https://via.placeholder.com/150" alt="الصورة الشخصية" class="profile-image">
                    @endif
                </div>
                <div class="profile-info">
                    <h2>{{ $user->name }}</h2>
                    <p><strong>البريد الإلكتروني:</strong> {{ $user->email }}</p>
                    <p><strong>رقم الهاتف:</strong> {{ $user->phone ?? 'غير متوفر' }}</p>
                    <p><strong>العنوان:</strong> {{ $user->address ?? 'غير متوفر' }}</p>
                    <p><strong>السيرة الذاتية:</strong> {{ $user->bio ?? 'غير متوفر' }}</p>
                </div>
                <div class="text-center mt-4">
                    <a href="{{ route('profile.edit') }}" class="btn btn-primary">تعديل البروفايل</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
