@include('layouts.app')

@include('layouts.sidebar')



    <div class="container mt-5">
        <div class="text-center">
            <!-- رسالة ترحيبية -->
            <h1>مرحبًا يا, {{Auth::user()->name}}</h1>
            <p class="lead">اختر أحد الخيارات التالية للبدء:</p>
        </div>

        <!-- الأزرار -->
        <div class="row justify-content-center mt-4">
            <!-- زر قائمة الحرفيين -->
            <div class="col-md-4 mb-3">
                <a href="{{route('artisans.index')}}" class="btn btn-primary btn-lg w-100 py-3">
                    <i class="fas fa-users"></i> <!-- أيقونة -->
                    <br>
                    قائمة الحرفيين
                </a>
            </div>

            <!-- زر قائمة المشاكل -->
            <div class="col-md-4 mb-3">
                <a href="{{ route('problems.index') }}" class="btn btn-success btn-lg w-100 py-3">
                    <i class="fas fa-tasks"></i> <!-- أيقونة -->
                    <br>
                    قائمة المشاكل
                </a>
            </div>

            <!-- زر إنشاء مشكلة جديدة -->
            <div class="col-md-4 mb-3">
                <a href="{{ route('problems.create') }}" class="btn btn-warning btn-lg w-100 py-3">
                    <i class="fas fa-plus"></i> <!-- أيقونة -->
                    <br>
                    إنشاء مشكلة جديدة
                </a>
            </div>
        </div>
    </div>

    <!-- إضافة Font Awesome للأيقونات -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
