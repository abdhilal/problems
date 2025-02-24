<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل حساب - Broblems</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">

</head>
<body>
    <div class="register-container">
        <h1><i class="fas fa-user-plus"></i> تسجيل حساب جديد</h1>
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- نوع المستخدم -->
            <div class="form-group">
                <label for="role" class="form-label"><i class="fas fa-user-tag"></i> نوع المستخدم</label>
                <div class="role-select">
                    <select name="role" id="role">
                        <option value="customer" {{ old('role') == 'customer' ? 'selected' : '' }}>مستخدم عادي</option>
                        <option value="artisan" {{ old('role') == 'artisan' ? 'selected' : '' }}>حرفي</option>
                    </select>
                </div>
            </div>

            <!-- الاسم -->
            <div class="form-group">
                <label for="name" class="form-label"><i class="fas fa-user"></i> الاسم</label>
                <input id="name" class="form-control" type="text" name="name" value="{{ old('name') }}" required autofocus>
            </div>
  <!-- رقم الهاتف -->
  <div class="form-group">
    <label for="phone" class="form-label"><i class="fas fa-phone"></i> رقم الهاتف</label>
    <input id="phone" class="form-control" type="tel" name="phone" value="{{ old('phone') }}" required>
</div>
            <!-- البريد الإلكتروني -->
            <div class="form-group">
                <label for="email" class="form-label"><i class="fas fa-envelope"></i> البريد الإلكتروني</label>
                <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" required>
            </div>

            <!-- كلمة المرور -->
            <div class="form-group">
                <label for="password" class="form-label"><i class="fas fa-lock"></i> كلمة المرور</label>
                <input id="password" class="form-control" type="password" name="password" required>
            </div>

            <!-- تأكيد كلمة المرور -->
            <div class="form-group">
                <label for="password_confirmation" class="form-label"><i class="fas fa-lock"></i> تأكيد كلمة المرور</label>
                <input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required>
            </div>

            <!-- الحقول الخاصة بالحرفي -->
            <div id="artisan-fields" class="artisan-fields">


                <!-- المهنة -->
                <div class="form-group">
                    <label for="profession" class="form-label"><i class="fas fa-briefcase"></i> المهنة</label>
                    <input id="profession" class="form-control" type="text" name="profession" value="{{ old('profession') }}">
                </div>

                <!-- سنوات الخبرة -->
                <div class="form-group">
                    <label for="experience_years" class="form-label"><i class="fas fa-calendar-alt"></i> سنوات الخبرة</label>
                    <input id="experience_years" class="form-control" type="number" name="experience_years" value="{{ old('experience_years') }}">
                </div>

                <!-- الموقع -->
                <div class="form-group">
                    <label for="location" class="form-label"><i class="fas fa-map-marker-alt"></i> الموقع</label>
                    <input id="location" class="form-control" type="text" name="location" value="{{ old('location') }}">
                </div>
            </div>

            <!-- زر التسجيل -->
            <div class="form-group">
                <button type="submit" class="btn btn-primary">تسجيل</button>
            </div>

            <!-- رابط تسجيل الدخول -->
            <div class="text-center">
                <a href="{{ route('login') }}" class="toggle-link">لديك حساب بالفعل؟ سجل الدخول</a>
            </div>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const roleSelect = document.getElementById('role');
            const artisanFields = document.getElementById('artisan-fields');

            function toggleArtisanFields() {
                if (roleSelect.value === 'artisan') {
                    artisanFields.classList.add('show');
                } else {
                    artisanFields.classList.remove('show');
                }
            }

            roleSelect.addEventListener('change', toggleArtisanFields);
            toggleArtisanFields(); // تفعيل الدالة عند تحميل الصفحة
        });
    </script>
</body>
</html>
