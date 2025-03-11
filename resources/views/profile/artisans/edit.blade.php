@include('layouts.app')

@include('layouts.sidebar')

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2 class="mb-4">تعديل البروفايل</h2>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <form action="{{ route('profile-artisan.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
            <!-- التصنيفات -->
            <div class="mb-3">
                <label class="form-label fw-bold text-dark bg-warning p-2 rounded shadow-sm d-inline-block">
                    حدد خبراتك لكي تصلك إشعارات في المشاكل التي قد تهمك
                </label>                <div class="row">
                    @foreach($categories as $category)
                        <div class="col-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="categories[]" id="category_{{ $category->id }}" value="{{ $category->id }}"
                                    {{ optional($user->artisan->categories)->pluck('id')->contains($category->id) ? 'checked' : '' }}>
                                <label class="form-check-label" for="category_{{ $category->id }}">
                                    {{ $category->name }}
                                </label>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- نموذج تعديل البروفايل -->


                <!-- الاسم -->
                <div class="mb-3">
                    <label for="name" class="form-label">الاسم</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
                </div>


                <!-- رقم الهاتف -->
                <div class="mb-3">
                    <label for="phone" class="form-label">رقم الهاتف</label>
                    <input type="text" class="form-control" id="phone" name="phone" value="{{ $user->phone }}">
                </div>

                <!-- العنوان -->
                <div class="mb-3">
                    <label for="address" class="form-label">العنوان</label>
                    <input type="text" class="form-control" id="address" name="address" value="{{$user->address}}">
                </div>

                <!-- السيرة الذاتية -->
                <div class="mb-3">
                    <label for="address" class="form-label">نبذة عنك</label>
                    <input type="text" class="form-control" id="bio" name="bio" value="{{ $user->bio }}">
                </div>

                <!-- إذا كان المستخدم حرفيًا -->

                    <!-- المهنة -->
                    <div class="mb-3">
                        <label for="profession" class="form-label">المهنة</label>
                        <input type="text" class="form-control" id="profession" name="profession" value="{{ $user->artisan->profession }}">
                    </div>

                    <!-- عدد سنوات الخبرة -->
                    <div class="mb-3">
                        <label for="experience_years" class="form-label">عدد سنوات الخبرة</label>
                        <input type="number" class="form-control" id="experience_years" name="experience_years" value="{{ $user->artisan->experience_years }}">
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
