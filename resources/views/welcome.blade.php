<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Problems - منصة حل المشاكل</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css">

    <!-- إضافة خط Tajawal للعربية -->
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;700&display=swap" rel="stylesheet">
    <!-- إضافة Font Awesome للأيقونات -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">

</head>

<body>

    <!-- شريط التنقل (Navbar) -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">Problems</a>
            <div class="ms-auto">
                @auth
                <a href="{{ route('login') }}" class="btn btn-primary">حسابي</a>
                @endauth
                @guest
                    <a href="{{ route('register') }}" class="btn btn-outline-primary me-2">إنشاء حساب</a>
                    <a href="{{ route('login') }}" class="btn btn-primary">تسجيل الدخول</a>
                @endguest
            </div>
        </div>
    </nav>

    <!-- قسم البطل (Hero Section) -->
    <section class="hero-section">
        <div class="container">
            <h1>مرحبًا بكم في Problems</h1>
            <p>منصة تهدف إلى ربط المستخدمين بالحرفيين المحترفين لحل المشاكل المنزلية والمهنية بكل سهولة.</p>
            <a href="{{ route('problems.create') }}" class="btn btn-light btn-custom">نشر مشكلة جديدة</a>
        </div>
    </section>

    <!-- قسم الميزات (Features Section) -->
    <section class="features-section">
        <div class="container">
            <h2>ميزات المنصة</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="feature-card">
                        <i class="fas fa-search"></i>
                        <h3>بحث سريع</h3>
                        <p>ابحث عن الحرفيين المناسبين بسهولة وسرعة.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <i class="fas fa-hand-holding-usd"></i>
                        <h3>عروض تنافسية</h3>
                        <p>احصل على عروض متنوعة واختر الأفضل لك.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <i class="fas fa-shield-alt"></i>
                        <h3>آمن وسهل</h3>
                        <p>منصة آمنة وسهلة الاستخدام لضمان رضاك التام.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- قسم الإحصائيات (Stats Section) -->
    <section class="stats-section">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="stat-card">
                        <i class="fas fa-users"></i>
                        <h3>10,000+</h3>
                        <p>مستخدم مسجل</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card">
                        <i class="fas fa-tools"></i>
                        <h3>5,000+</h3>
                        <p>حرفي محترف</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card">
                        <i class="fas fa-check-circle"></i>
                        <h3>20,000+</h3>
                        <p>مشكلة تم حلها</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- التذييل (Footer) -->
    <footer class="footer">
        <div class="container">
            <p>&copy; 2023 Problems. جميع الحقوق محفوظة.</p>
            <div class="mt-3">
                <a href="#">عن المنصة</a>
                <a href="#">اتصل بنا</a>
                <a href="#">الشروط والأحكام</a>
            </div>
        </div>
    </footer>

    <!-- إضافة Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
