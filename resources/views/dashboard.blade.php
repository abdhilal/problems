@include('layouts.app')

   @include('layouts.sidebar')

        <!-- المحتوى الرئيسي -->
        <div class="main-content">
            <!-- الهيدر داخل المحتوى الرئيسي -->
            <div class="header">
                <h1>مرحبًا يا , {{Auth::user()->name}}</h1>
                <div class="user-info">
                    <img src="https://via.placeholder.com/40" alt="صورة المستخدم">
                </div>
            </div>

            <!-- المحتوى الداخلي -->
            <div class="content" id="content">
                <p>مرحبًا بك في لوحة التحكم. اختر قسمًا من القائمة الجانبية لعرض محتواه.</p>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->

</body>
</html>
