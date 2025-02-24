@include('layouts.app')

   @include('layouts.sidebar')
    <div class="container mt-5">
        <h2 class="mb-4">المحادثات</h2>

        <div class="list-group">
            @foreach($conversations as $userId => $messages)
                @php
                    $otherUser = $messages->first()->sender_id == Auth::id() ? $messages->first()->receiver : $messages->first()->sender;
                @endphp
                <a href="{{ route('messages.index', $otherUser->id) }}" class="list-group-item list-group-item-action">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="mb-1">{{ $otherUser->name }}</h5>
                            <p class="mb-1">{{ $messages->last()->message }}</p>
                            <small>{{ $messages->last()->created_at->diffForHumans() }}</small>
                        </div>
                        @if($messages->last()->receiver_id == Auth::id() && !$messages->last()->read)
                            <span class="badge bg-primary">جديد</span>
                        @endif
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</body>
</html>
