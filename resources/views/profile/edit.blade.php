

@include('layouts.app')

   @include('layouts.sidebar')

   <div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2 class="mb-4">تعديل البروفايل</h2>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- الاسم -->
                <div class="mb-3">
                    <label for="name" class="form-label">الاسم</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
                </div>

                <!-- البريد الإلكتروني -->
                <div class="mb-3">
                    <label for="email" class="form-label">البريد الإلكتروني</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
                </div>

                <!-- رقم الهاتف -->
                <div class="mb-3">
                    <label for="phone" class="form-label">رقم الهاتف</label>
                    <input type="text" class="form-control" id="phone" name="phone" value="{{ $user->phone }}">
                </div>

                <!-- العنوان -->
                <div class="mb-3">
                    <label for="address" class="form-label">العنوان</label>
                    <input type="text" class="form-control" id="address" name="address" value="{{ $user->address }}">
                </div>

                <!-- السيرة الذاتية -->
                <div class="mb-3">
                    <label for="bio" class="form-label">السيرة الذاتية</label>
                    <textarea class="form-control" id="bio" name="bio" rows="4">{{ $user->bio }}</textarea>
                </div>

@if($user->artisan)

                <div class="mb-3">
                    <label for="bio" class="form-label">المهنة</label>
                    <textarea class="form-control" id="bio" name="profession" rows="4">{{ $user->artisan->profession }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="bio" class="form-label">عدد سنوات الخبرة</label>
                    <textarea class="form-control" id="bio" name="experience_years" rows="4">{{ $user->artisan->experience_years }}</textarea>
                </div>

                @endif


                <!-- الصورة الشخصية -->
                <div class="mb-3">
                    <label for="profile_image" class="form-label">الصورة الشخصية</label>
                    <input type="file" class="form-control" id="profile_image" name="profile_image">
                    @if($user->profile_image)
                        <img src="{{ asset('storage/' . $user->profile_image) }}" alt="الصورة الشخصية" class="img-thumbnail mt-2" width="100">
                    @endif
                </div>

                <!-- زر التحديث -->
                <button type="submit" class="btn btn-primary">تحديث البيانات</button>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
