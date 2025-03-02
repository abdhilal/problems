     <!-- السايد بار (العمود الجانبي) -->
     <div class="sidebar">
        <h2>لوحة التحكم</h2>
        <ul>
            <li><a href="{{route('home.index')}}" onclick="showContent('home')"><i class="fas fa-home"></i> الصفحة الرئيسية</a></li>
            <li><a href="{{route(Auth::user()->artisan?'artisans.notifications.index':'user.notifications.index')}}" onclick="showContent('notifications')"><i class="fas fa-bell"></i> الإشعارات</a></li>
            <li><a href="{{route('messages.conversations')}}" onclick="showContent('messages')"><i class="fas fa-envelope"></i> الرسائل</a></li>
            <li><a href="{{route('my.problems')}}" onclick="showContent('my-issues')"><i class="fas fa-tasks"></i> مشكلاتي</a></li>
            <li><a href="{{route('profile.show')}}" onclick="showContent('profile')"><i class="fas fa-user"></i> البروفايل</a></li>
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
