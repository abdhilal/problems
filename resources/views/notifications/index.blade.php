@include('layouts.app')

   @include('layouts.sidebar')

   <body>
    <div class="container mt-5">
        <h2 class="mb-4">الإشعارات</h2>

        @if($notifications->isEmpty())
            <div class="alert alert-info">لا توجد إشعارات جديدة.</div>
        @else
            <ul class="list-group">
                @foreach($notifications as $notification)
                    <li class="list-group-item mb-2{{ is_null($notification->read_at) ? 'unread' : '' }}">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                {{ $notification->message }}
                                <br>
                                <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                            </div>
                            @if(is_null($notification->read_at))
                                <form action="{{ route('notifications.markAsRead', $notification->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-primary">تحديد كمقروء</button>
                                </form>
                            @endif
                        </div>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
