<x-guest-layout>
    <x-slot name="channels">
        <div class="row align-items-start mb-20">

            <div class="col-12 col-md-6 mb-20 mb-md-0 text-center text-md-start">
                <h5 class="neutral-0 mb-10 text-18-semibold">{{ __('Канал Дзен') }}</h5>
                <p class="text-sm neutral-600 mb-15">{{ __('Новости и материалы о цифровых финансах и финтехе') }}</p>
                <a href="https://dzen.ru/digital_fintech" target="_blank" rel="noopener noreferrer" class="btn btn-brand-5 hover-up  neutral-100">
                    {{ __('Перейти в канал') }}

                </a>
            </div>
            <div class="col-12 col-md-6 text-center text-md-start">
                <h5 class="neutral-0 mb-10 text-18-semibold">{{ __('Канал Telegram') }}</h5>
                <p class="text-sm neutral-600 mb-15">{{ __('Официальный канал NEXUS — анонсы и обновления') }}</p>
                <a href="https://t.me/dipp_NEXUS" target="_blank" rel="noopener noreferrer" class="btn btn-brand-5 hover-up neutral-100">
                    {{ __('Перейти в канал') }}

                </a>
            </div>
        </div>
    </x-slot>

    <!-- Session Status / сообщение при редиректе с защищённой страницы -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    @if (session('error'))
        <div class="mb-4 font-medium text-sm text-amber-600">{{ session('error') }}</div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Пароль')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Запомнить меня') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            {{--@if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif--}}

            <x-primary-button class="ms-3">
                {{ __('Войти') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
