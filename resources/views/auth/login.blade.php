<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-100 via-white to-yellow-100 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full bg-white p-10 rounded-2xl shadow-xl">
            <div class="text-center">
                <!-- Ikon Kuli -->
                <svg class="mx-auto h-14 w-14 text-yellow-600" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 14c-2.21 0-4-1.79-4-4V8a4 4 0 118 0v2c0 2.21-1.79 4-4 4zM4 20h16v-2c0-2.21-1.79-4-4-4H8c-2.21 0-4 1.79-4 4v2z" />
                </svg>
                <h2 class="mt-4 text-3xl font-bold text-gray-800">Gowork</h2>
                <p class="text-sm text-gray-600">Masuk ke sistem Agen Kuli</p>
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <!-- Form Login -->
            <form method="POST" action="{{ route('login') }}" class="mt-6 space-y-5">
                @csrf

                <!-- Email -->
                <div>
                    <x-input-label for="email" :value="'Email'" />
                    <x-text-input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username"
                        class="block mt-1 w-full" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div>
                    <x-input-label for="password" :value="'Kata Sandi'" />
                    <x-text-input id="password" type="password" name="password" required autocomplete="current-password"
                        class="block mt-1 w-full" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me -->
                <div class="flex items-center">
                    <input id="remember_me" type="checkbox" name="remember"
                        class="h-4 w-4 text-yellow-600 border-gray-300 rounded focus:ring-yellow-500">
                    <label for="remember_me" class="ml-2 block text-sm text-gray-600">Ingat saya</label>
                </div>

                <!-- Button & Forgot Password -->
                <div class="flex items-center justify-between">
                    @if (Route::has('password.request'))
                        <a class="text-sm text-blue-600 hover:underline" href="{{ route('password.request') }}">
                            Lupa kata sandi?
                        </a>
                    @endif

                    <x-primary-button class="bg-yellow-600 hover:bg-yellow-700">
                        Masuk
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
