@include('layouts.app')

@include('layouts.sidebar')

<div class="container mt-5">
    <!-- عنوان الصفحة -->
    <h2 class="mb-4">تفاصيل الحرفي: {{ $artisan->user->name }}</h2>

    <!-- معلومات الحرفي -->
    <div class="row">
        <!-- صورة الحرفي -->
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm">
                @if($artisan->user->profile_image)
                    <img src="{{ asset('storage/' . $artisan->user->profile_image) }}" class="card-img-top" alt="صورة الحرفي" style="height: 300px; object-fit: cover;">
                @else
                    <img src="{{ asset('storage/problems/problem.webp') }}" class="card-img-top" alt="صورة افتراضية" style="height: 300px; object-fit: cover;">
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{ $artisan->user->name }}</h5>
                    <p class="card-text">
                        <i class="fas fa-briefcase"></i> <strong>المهنة:</strong> {{ $artisan->profession }}
                    </p>

                    <p class="card-text">
                        <i class="fas fa-map-marker-alt"></i> <strong>الموقع:</strong> {{ $artisan->user->address }}
                    </p>
                    <p class="card-text">
                        <i class="fas fa-phone-alt"></i> <strong>رقم الهاتف:</strong> {{ $artisan->user->phone ?? 'غير متوفر' }}
                    </p>
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">الخبرات</h5>

                                @foreach ($artisan->categories as $category)
                                    <span>-{{ $category->name }}</span>
                                @endforeach


                        </div>
                    </div>
                    <p class="card-text">
                        <i class="fas fa-star"></i> <strong>التقييم:</strong>
                        @if($artisan->reviews->count() > 0)
                            {{ number_format($artisan->reviews->avg('rating'), 1) }} ⭐ ({{ $artisan->reviews->count() }} تقييم)
                        @else
                            لا توجد تقييمات
                        @endif
                    </p>
                </div>
            </div>
        </div>

        <!-- التقييمات -->
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h3 class="card-title mb-4">التقييمات</h3>

                    @if($artisan->reviews->isEmpty())
                        <div class="alert alert-info">لا توجد تقييمات حتى الآن.</div>
                        <div class="mb-3">
                            <a href="{{ route('reviews.create', $artisan->id) }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> إضافة تقييم
                            </a>
                        </div>
                    @else
                        <div class="mb-3">
                            <a href="{{ route('reviews.create', $artisan->id) }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> إضافة تقييم
                            </a>
                        </div>
                        @foreach($artisan->reviews as $review)
                            <div class="mb-4 p-3 border rounded">
                                <h5 class="mb-2">التقييم: {{ $review->rating }}/5 <i class="fas fa-star"></i></h5>
                                <p class="mb-2">{{ $review->comment }}</p>
                                <p class="text-muted mb-0">
                                    <strong>مقدم من:</strong> {{ $review->user->name }}
                                </p>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- زر الرجوع -->
    <div class="mt-4">
        <a href="{{ route('artisans.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> العودة إلى القائمة
        </a>
    </div>
</div>

<!-- إضافة Font Awesome للأيقونات -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

</body>
</html>
