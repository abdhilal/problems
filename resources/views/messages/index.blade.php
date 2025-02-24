@include('layouts.app')

@include('layouts.sidebar')

<div class="container mt-5">
    <h2 class="mb-4">المحادثة مع : {{ $receiver->name }}</h2>

    <!-- عرض الرسائل -->
    <div class="card shadow-sm" style="height: 500px; overflow-y: auto; width:70% ">
        <div class="card-body p-2">
            <div class="messages">
                @foreach($messages as $message)
                    <div class="message mb-2 {{ $message->sender_id == Auth::id() ? 'text-end' : 'text-start' }}">
                        <div class="card {{ $message->sender_id == Auth::id() ? 'bg-primary text-white' : 'bg-light' }} p-1" style="max-width: 60%; font-size: 12px;">
                            <div class="card-body p-1">
                                <p class="card-text m-0" style="font-size: 12px; line-height: 1.4;">{{ $message->message }}</p>
                                <small class="text-muted" style="font-size: 10px;">
                                    {{ $message->created_at->diffForHumans() }}
                                    @if($message->sender_id == Auth::id())
                                        @if($message->read)
                                            <i class="fas fa-check-double text-success"></i>
                                        @else
                                            <i class="fas fa-check"></i>
                                        @endif
                                    @endif
                                </small>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- نموذج إرسال رسالة جديدة -->
    <div class="mt-3 " style="height: 500px;  width:70% ">
        <form action="{{ route('messages.store', $receiver->id) }}" method="POST">
            @csrf
            <div class="input-group">
                <textarea name="message" class="form-control" rows="2" placeholder="اكتب رسالتك هنا..." required style="font-size: 12px;"></textarea>
                <button type="submit" class="btn btn-primary" style="font-size: 12px;">إرسال</button>
            </div>
        </form>
        <div class="mt-3">
            <a href="{{ route('artisans.index') }}" class="btn btn-secondary" style="font-size: 12px;">
                <i class="fas fa-arrow-left"></i> العودة إلى القائمة
            </a>
        </div>
    </div>

    <!-- زر الرجوع -->

</div>

<!-- إضافة Font Awesome للأيقونات -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<script>
    // تحديث الرسائل كل 5 ثوانٍ
    setInterval(function() {
        fetch(`{{ route('messages.index', $receiver->id) }}`)
            .then(response => response.text())
            .then(data => {
                document.querySelector('.messages').innerHTML = new DOMParser()
                    .parseFromString(data, 'text/html')
                    .querySelector('.messages').innerHTML;
            });
    }, 5000);
</script>

</body>
</html>
