<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

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
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-primary-600 shadow-sm focus:ring-primary-500 dark:focus:ring-primary-600 dark:focus:ring-offset-gray-800" name="remember">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
    @if(session('registered_pending'))
        <div id="registeredPendingModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-40">
            <div class="bg-white rounded-lg shadow-lg max-w-lg w-full p-6">
                <div class="flex items-start justify-between">
                    <h3 class="text-lg font-bold">Pendaftaran Diterima</h3>
                    <button id="closePendingModal" class="text-gray-500 hover:text-gray-700">✕</button>
                </div>
                <div class="mt-4 text-sm text-gray-700">
                    <p>{{ session('registered_pending') }}</p>
                </div>
                <div class="mt-6 text-right">
                    <a href="{{ route('home') }}" class="px-4 py-2 bg-primary-600 text-white rounded-lg">Tutup</a>
                </div>
            </div>
        </div>

        <script>
            (function(){
                const modal = document.getElementById('registeredPendingModal');
                const close = document.getElementById('closePendingModal');
                if (!modal) return;
                close.addEventListener('click', function(){ modal.style.display = 'none'; });
                // auto-hide after 8 seconds
                setTimeout(()=>{ if (modal) modal.style.display = 'none'; }, 8000);
            })();
        </script>
    @endif
</x-guest-layout>
