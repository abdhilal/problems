@include('layouts.app')

   @include('layouts.sidebar')


    <div class="container mt-5">
        <h2 class="mb-4">قائمة المشاكل</h2>

        <!-- عرض رسالة نجاح إذا تمت إضافة مشكلة جديدة -->
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- زر إضافة مشكلة جديدة -->
        <a href="{{ route('problems.create') }}" class="btn btn-primary mb-4">إضافة مشكلة جديدة</a>

        <!-- قائمة المشاكل -->
        <div class="row">
            @foreach($problems as $problem)
                <div class="col-md-3">
                    <div class="card mb-4">
                        <!-- صورة المشكلة -->
                        @if($problem->image)
                        <img src="{{ asset('storage/' . $problem->image) }}" class="card-img-top" alt="{{ $problem->title }}" style="width: 100%; height: 200px; object-fit: cover;">
                    @else
                        <img src="{{ asset('storage/problems/problem.webp') }}" class="card-img-top" alt="صورة افتراضية" style="width: 100%; height: 200px; object-fit: cover;">
                    @endif


                        <div class="card-body">
                            <!-- عنوان المشكلة -->
                            <h5 class="card-title">{{ $problem->title }}</h5>

                            <!-- وصف المشكلة -->
                            <p class="card-text">{{ Str::limit($problem->description, 100) }}</p>
                            <p class="card-text">
                                <strong>الحالة:</strong>
                                @if($problem->status == 'resolved')
                                    <span class="badge bg-primary">منتهية</span>
                                @else
                                    <span class="badge bg-danger">مفتوحة</span>
                                @endif
                            </p>
                            <!-- الأولوية -->
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

                            <!-- الموقع -->
                            <p class="card-text">
                                <strong>الموقع:</strong> {{ $problem->location }}
                            </p>

                            <!-- رابط لعرض تفاصيل المشكلة -->
                            <a href="{{ route('problems.show', $problem->id) }}" class="btn btn-info">عرض التفاصيل</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
