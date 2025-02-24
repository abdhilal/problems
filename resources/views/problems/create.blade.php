@include('layouts.app')

   @include('layouts.sidebar')

<div class="container mt-5">
    <h2 class="mb-4">إضافة مشكلة جديدة</h2>

    <!-- عرض رسالة نجاح عند إضافة المشكلة -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- نموذج إدخال البيانات -->
    <form action="{{ route('problems.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- عنوان المشكلة -->
        <div class="mb-3">
            <label for="title" class="form-label">عنوان المشكلة</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" required>
            @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- وصف المشكلة -->
        <div class="mb-3">
            <label for="description" class="form-label">الوصف</label>
            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4" required>{{ old('description') }}</textarea>
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- رفع صورة -->
        <div class="mb-3">
            <label for="image" class="form-label">رفع صورة (اختياري)</label>
            <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image">
            @error('image')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- تحديد الأولوية -->
        <div class="mb-3">
            <label for="priority" class="form-label">الأولوية</label>
            <select class="form-select @error('priority') is-invalid @enderror" id="priority" name="priority" required>
                <option value="normal">منخفضة</option>
                <option value="urgent">متوسطة</option>
                <option value="emergency">عالية</option>
            </select>
            @error('priority')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- الموقع -->
        <div class="mb-3">
            <label for="location" class="form-label">الموقع</label>
            <input type="text" class="form-control @error('location') is-invalid @enderror" id="location" name="location" value="{{ old('location') }}" required>
            @error('location')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- زر الإرسال -->
        @guest
        <a  href="{{route('register')}}" class="btn btn-primary mb-3">إرسال المشكلة</a>

        @endguest
        @auth
        <button type="submit" class="btn btn-primary mb-3">إرسال المشكلة</button>

        @endauth
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>



