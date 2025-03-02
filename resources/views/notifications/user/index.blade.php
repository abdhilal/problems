@include('layouts.app')
@include('layouts.sidebar')

<body>
    <div class="container mt-5">
        <h2 class="mb-4">الإشعارات</h2>

        @if(Auth::user()->notifications->isEmpty())
            <div class="alert alert-info">لا توجد إشعارات جديدة.</div>
        @else
            <ul class="list-group">
                @foreach(Auth::user()->notifications as $notification)
                    <a href="#"
                       onclick="markNotificationAsRead(event, '{{ route('user.notifications.markAsRead', $notification->id) }}', '{{ route('problems.show', $notification->data['problem_id']) }}')"
                       class="list-group-item mb-2 {{ is_null($notification->read_at) ? 'unread' : '' }} text-decoration-none text-dark d-flex justify-content-between align-items-center">
                        <div>
                            {{ $notification->data['message'] }}
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

        <div class="alert alert-info mt-4">
            عدد الإشعارات: {{ Auth::user()->notifications->count() }}
        </div>
    </div>

    <script>
        function markNotificationAsRead(event, markAsReadUrl, redirectUrl) {
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
