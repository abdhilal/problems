@include('layouts.app')
@include('layouts.sidebar')

<body>
    <div class="container mt-5">
        <h2 class="mb-4">الإشعارات</h2>

        <div id="notifications">
            @if($notifications->isEmpty())
                <div class="alert alert-info">لا توجد إشعارات جديدة.</div>
            @else
                <ul class="list-group">
                    @foreach($notifications as $notification)
                        <a href="#"
                        onclick="markNotificationAsRead( '{{ route('notifications.markAsRead', $notification->id) }}', '{{ route('problems.show', $notification->problem_id) }}')"
                        class="list-group-item mb-2 {{ is_null($notification->read_at) ? 'unread' : '' }} text-decoration-none text-dark d-flex justify-content-between align-items-center">
                            <div>
                                {{ $notification->message }}
                                <br>
                                <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                            </div>
                            @if(is_null($notification->read_at))
                                <span class="badge bg-primary">جديد</span>
                            @endif
                        </a>
                    @endforeach
                </ul>
            @endif
        </div>

        <div class="alert alert-info mt-4">
            عدد الإشعارات: {{ $notifications->count() }}

        </div>
    </div>

    <script>
        function markNotificationAsRead(markAsReadUrl, redirectUrl) {
            event.preventDefault(); // منع التحميل الافتراضي للرابط
            fetch(markAsReadUrl, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                }
            }).then(() => {
                window.location.href = redirectUrl; // توجيه المستخدم بعد تحديد الإشعار كمقروء
            }).catch(error => console.error('Error:', error));
        }
    </script>

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
            // إضافة الإشعار الجديد إلى قائمة الإشعارات
            var notificationsList = document.querySelector('#notifications ul');
            if (notificationsList) {
                var newNotification = document.createElement('li');
                newNotification.className = 'list-group-item mb-2 unread text-decoration-none text-dark d-flex justify-content-between align-items-center';
                newNotification.innerHTML = `
                    <div>
                        ${data.message}
                        <br>
                        <small class="text-muted">${new Date().toLocaleTimeString()}</small>
                    </div>
                    <span class="badge bg-primary">جديد</span>
                `;
                notificationsList.prepend(newNotification);
            } else {
                // إذا لم تكن هناك إشعارات سابقة، قم بإنشاء قائمة جديدة
                var notificationsDiv = document.getElementById('notifications');
                notificationsDiv.innerHTML = `
                    <ul class="list-group">
                        <li class="list-group-item mb-2 unread text-decoration-none text-dark d-flex justify-content-between align-items-center">
                            <div>
                                ${data.message}
                                <br>
                                <small class="text-muted">${new Date().toLocaleTimeString()}</small>
                            </div>
                            <span class="badge bg-primary">جديد</span>
                        </li>
                    </ul>
                `;
            }

            // تحديث عدد الإشعارات
            var notificationCount = document.querySelector('.alert-info.mt-4');
            if (notificationCount) {
                var currentCount = parseInt(notificationCount.textContent.match(/\d+/)[0]);
                notificationCount.textContent = `عدد الإشعارات: ${currentCount + 1}`;
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
