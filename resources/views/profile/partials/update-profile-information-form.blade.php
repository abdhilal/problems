<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)"
                required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)"
                required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            <div>
                <x-input-label for="email" :value="__('Phone')" />
                <x-text-input id="email" name="phone" type="text" class="mt-1 block w-full" :value="old('email', $user->phone)"
                    required autocomplete="username" />
                <x-input-error class="mt-2" :messages="$errors->get('phone')" />

                <div>
                    <x-input-label for="email" :value="__('Address')" />
                    <x-text-input id="email" name="address" type="text" class="mt-1 block w-full"
                        :value="old('address', $user->address)" required autocomplete="username" />
                    <x-input-error class="mt-2" :messages="$errors->get('address')" />
                    <div>
                        <x-input-label for="email" :value="__('Bio')" />
                        <x-text-input id="email" name="bio" type="text" class="mt-1 block w-full"
                            :value="old('bio', $user->bio)" required autocomplete="username" />
                        <x-input-error class="mt-2" :messages="$errors->get('bio')" />


                        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                            <div>
                                <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                                    {{ __('Your email address is unverified.') }}

                                    <button form="send-verification"
                                        class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                                        {{ __('Click here to re-send the verification email.') }}
                                    </button>
                                </p>

                                @if (session('status') === 'verification-link-sent')
                                    <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                                        {{ __('A new verification link has been sent to your email address.') }}
                                    </p>
                                @endif
                            </div>
                        @endif
                    </div>

                    <div class="flex items-center gap-4">
                        <x-primary-button>{{ __('Save') }}</x-primary-button>

                        @if (session('status') === 'profile-updated')
                            <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                                class="text-sm text-gray-600 dark:text-gray-400">{{ __('Saved.') }}</p>
                        @endif
                    </div>
    </form>
</section>

{{--
<h3 class="mt-4">التقييمات</h3>
@if($artisan->reviews->isEmpty())
    <div class="alert alert-info">لا توجد تقييمات حتى الآن.</div>
@else
    @foreach($artisan->reviews as $review)
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">التقييم: {{ $review->rating }}/5</h5>
                <p class="card-text">{{ $review->comment }}</p>
                <p class="card-text">
                    <strong>مقدم من:</strong> {{ $review->user->name }}
                </p>
            </div>
        </div>
    @endforeach
@endif

<!-- زر إضافة تقييم جديد -->
<a href="{{ route('reviews.create', $artisan->id) }}" class="btn btn-primary">إضافة تقييم</a> --}}
