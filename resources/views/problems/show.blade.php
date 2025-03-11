@include('layouts.app')

   @include('layouts.sidebar')

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تفاصيل المشكلة</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css">
    <style>
        /* تخصيصات إضافية */
        .problem-sidebar {
            background-color: #f8f9fa;
            padding: 20px;
            border-right: 1px solid #ddd;
            height: 100vh;
            overflow-y: auto;
        }

        .main-content {
            padding: 20px;
            height: 100vh;
            overflow-y: auto;
        }

        .card-img-top {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .badge {
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- القسم الأيسر (السايد بار) -->
            <div class="col-md-4 problem-sidebar">
                <h2 class="mb-4">تفاصيل المشكلة</h2>
                <div class="card mb-4">
                    @if($problem->image)
                        <img src="{{ asset('storage/' . $problem->image) }}" class="card-img-top" alt="{{ $problem->title }}">
                    @else
                        <img src="{{ asset('storage/problems/problem.webp') }}" class="card-img-top" alt="صورة افتراضية">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $problem->title }}</h5>
                        <p class="card-text">{{ $problem->description }}</p>

                        <p class="card-text">
                            <strong>الحالة:</strong>
                            @if($problem->status == 'resolved')
                                <span class="badge bg-primary">منتهية</span>
                            @else
                                <span class="badge bg-danger">مفتوحة</span>
                            @endif
                        </p>
                        <p class="card-text">
                            <strong>الأولوية:</strong>
                            @if($problem->priority == 'normal')
                                <span class="badge bg-primary">منخفضة</span>
                            @elseif($problem->priority == 'urgent')
                                <span class="badge bg-warning">متوسطة</span>
                            @else
                                <span class="badge bg-danger">عالية</span>
                            @endif
                        </p>
                        <p class="card-text">
                            <strong>الموقع:</strong> {{ $problem->location }}
                        </p>
                        <a href="{{ route('messages.index', $problem->user->id) }}" class="btn btn-primary ml-2">
                            <i class="fas fa-comment-alt"></i> تواصل مع صاحب المشكلة
                        </a>
                    </div>
                </div>
                <a href="{{ route('problems.index') }}" class="btn btn-secondary">العودة إلى القائمة</a>
            </div>

            <!-- القسم الرئيسي -->
            <div class="col-md-8 main-content">
                <!-- قسم تقديم العروض (للحرفيين فقط) -->
                @if(auth()->check() && auth()->user()->role == 'artisan')
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">تقديم عرض لحل المشكلة</h5>
                            <form action="{{ route('offers.store', $problem->id) }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="price" class="form-label">السعر</label>
                                    <input type="number" class="form-control" id="price" name="price" required>
                                </div>
                                <div class="mb-3">
                                    <label for="description" class="form-label">وصف العرض</label>
                                    <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">تقديم العرض</button>
                            </form>
                        </div>
                    </div>
                @endif

                <!-- عرض العروض المقدمة -->
                <h3 class="mt-4">العروض المقدمة</h3>
                @if($problem->offers->isEmpty())
                    <div class="alert alert-info">لا توجد عروض مقدمه حتى الآن.</div>
                @else
                    @foreach($problem->offers as $offer)
                        <div class="card mb-3">
                            <div class="card-body">
                                <h5 class="card-title">السعر: {{ $offer->price }}</h5>
                                <p class="card-text">{{ $offer->description }}</p>
                                <p class="card-text">
                                    <strong>الحالة:</strong>
                                    @if($offer->status == 'pending')
                                        <span class="badge bg-warning">قيد الانتظار</span>
                                    @elseif($offer->status == 'accepted')
                                        <span class="badge bg-success">مقبول</span>
                                    @else
                                        <span class="badge bg-danger">مرفوض</span>
                                    @endif
                                </p>
                                <a href="{{ route('artisans.show', $offer->artisan->id) }}" class="btn bg-success text-white">

                                <p class="card-text">
                                    <strong>مقدم من:</strong> {{ $offer->artisan->user->name }}
                                </p>
                                </a>

                                <!-- قبول أو رفض العرض (لصاحب المشكلة فقط) -->
                                @if(auth()->check() && auth()->id() == $problem->user_id && $offer->status == 'pending')
                                    <form action="{{ route('offers.accept', [$problem->id, $offer->id]) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-success">قبول </button>
                                    </form>
                                    <form action="{{ route('offers.reject', [$problem->id, $offer->id]) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-danger">رفض</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
