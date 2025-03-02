@include('layouts.app')

@include('layouts.sidebar')
@section('title', 'قائمة الحرفيين')

<div class="container mt-5">
    <h2 class="mb-4">قائمة الحرفيين</h2>

    <div class="row">
        @foreach($artisans as $artisan)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <!-- صورة الحرفي -->
                    @if($artisan->user->profile_image)
                        <img src="{{ asset('storage/' . $artisan->user->profile_image) }}" class="card-img-top" alt="صورة الحرفي" style="width: 100%; height: 200px; object-fit: cover;">
                    @else
                        <img src="{{ asset('storage/problems/problem.webp') }}" class="card-img-top" alt="صورة افتراضية" style="width: 100%; height: 200px; object-fit: cover;">
                    @endif

                    <div class="card-body">
                        <!-- اسم الحرفي -->
                        <h5 class="card-title">{{ $artisan->user->name }}</h5>

                        <!-- المهنة -->
                        <p class="card-text">
                            <i class="fas fa-briefcase"></i> <strong>المهنة:</strong> {{ $artisan->profession }}
                        </p>

                        <!-- الموقع -->
                        <p class="card-text">
                            <i class="fas fa-map-marker-alt"></i> <strong>الموقع:</strong> {{ $artisan->user->address }}
                        </p>

                        <!-- رقم الهاتف -->
                        <p class="card-text">
                            <i class="fas fa-phone-alt"></i> <strong>رقم الهاتف:</strong> {{ $artisan->user->phone ?? 'غير متوفر' }}
                        </p>

                        <!-- التقييمات -->
                        <p class="card-text">
                            <i class="fas fa-star"></i> <strong>التقييم:</strong>
                            @if($artisan->reviews->count() > 0)
                                {{ number_format($artisan->reviews->avg('rating'), 1) }} ⭐ ({{ $artisan->reviews->count() }} تقييم)
                            @else
                                لا توجد تقييمات
                            @endif
                        </p>

                        <!-- زر عرض التفاصيل -->
                        <a href="{{ route('artisans.show', $artisan->id) }}" class="btn bg-success text-white">
                            <i class="fas fa-info-circle"></i> عرض التفاصيل
                        </a>

                        <!-- زر تواصل معه -->
                        <a href="{{ route('messages.index', $artisan->user->id) }}" class="btn btn-primary ml-2">
                            <i class="fas fa-comment-alt"></i> تواصل
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- إضافة Font Awesome للأيقونات -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

</body>
</html>
