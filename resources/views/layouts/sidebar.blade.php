<!-- السايد بار (العمود الجانبي) -->
<div class="sidebar">
    <h2>لوحة التحكم</h2>
    <ul>
        <li><a href="{{ route('home.index') }}" onclick="showContent('home')"><i class="fas fa-home"></i> الصفحة الرئيسية</a></li>
        <li>
            <a href="{{ route('notifications') }}" onclick="showContent('notifications')">
                <i class="fas fa-bell position-relative">
                    <!-- عرض العدد فقط في دائرة صغيرة أعلى الأيقونة إذا كان العدد أكبر من 0 -->
                    @php
                        $unreadCount = Auth::user()->notifications->whereNull('read_at')->count();
                    @endphp
                    <span id="notification-count" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                          style="display: {{ $unreadCount > 0 ? 'block' : 'none' }}">
                        {{ $unreadCount }}
                    </span>
                </i>
                الإشعارات
            </a>
        </li>
        <li><a href="{{ route('messages.conversations') }}" onclick="showContent('messages')"><i class="fas fa-envelope"></i> الرسائل</a></li>
        <li><a href="{{ route('my.problems') }}" onclick="showContent('my-issues')"><i class="fas fa-tasks"></i> مشكلاتي</a></li>
        <li><a href="{{ route('profile.show') }}" onclick="showContent('profile')"><i class="fas fa-user"></i> البروفايل</a></li>
        <li><a href="#" onclick="showContent('settings')"><i class="fas fa-cog"></i> الإعدادات</a></li>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <li>
                <button type="submit" class="btn" style="border: none; background: none; color: inherit;">
                    <i class="fas fa-sign-out-alt"></i> تسجيل الخروج
                </button>
            </li>
        </form>
    </ul>
</div>

<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script>
    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('{{ config('broadcasting.connections.pusher.key') }}', {
        cluster: '{{ config('broadcasting.connections.pusher.options.cluster') }}',
        authEndpoint: '/broadcasting/auth', // تأكيد المصادقة مع Laravel
        auth: {
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        }
    });

    var channel = pusher.subscribe('private-notify.{{ auth()->user()->id }}');

    channel.bind('done', function(data) {
        console.log("Received event:", data);

        // تحديث عدد الإشعارات غير المقروءة
        var notificationCount = document.getElementById('notification-count');
        if (notificationCount) {
            var currentCount = parseInt(notificationCount.textContent) || 0;
            notificationCount.textContent = currentCount + 1;

            // إظهار الشارة إذا كانت أكثر من 0
            if (currentCount + 1 > 0) {
                notificationCount.style.display = 'block';
            }
        }
    });
</script>
