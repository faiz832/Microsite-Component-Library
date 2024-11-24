@section('title', 'Login - Microsite Component Library')

<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <h1 class="text-xl font-semibold text-center text-slate-700 dark:text-slate-200 mb-6">
        Sign in to MCLibrary
    </h1>
    <div class="border dark:border-slate-800 rounded-lg bg-white dark:bg-slate-900/30 p-6">
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div class="mb-4">
                <x-text-input id="email" class="block mt-1 w-full p-2 border rounded" type="email"
                    name="email" :value="old('email')" required autofocus autocomplete="username"
                    placeholder="Email" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mb-4">
                <x-text-input id="password" class="block mt-1 w-full p-2 border rounded" type="password"
                    name="password" required autocomplete="current-password" placeholder="Password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            <div class="flex items-center justify-between mb-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox"
                        class="rounded border-gray-300 dark:border-slate-700 text-primary shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50 dark:bg-slate-900"
                        name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>

                @if (Route::has('password.request'))
                    <a class="text-sm text-blue-600 hover:underline" href="{{ route('password.request') }}">
                        {{ __('Forgot password?') }}
                    </a>
                @endif
            </div>

            <div class="mb-4">
                <x-primary-button
                    class="w-full justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white dark:text-white bg-slate-900 dark:bg-purple-600 hover:bg-slate-700 dark:hover:bg-purple-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-600 transition">
                    {{ __('Sign in') }}
                </x-primary-button>
            </div>
        </form>
        <div class="flex items-center my-3">
            <div class="grow">
                <hr>
            </div>
            <div class="text-center px-3 text-slate-700 dark:text-slate-200">
                or
            </div>
            <div class="grow">
                <hr>
            </div>
        </div>
        <div class="mt-4">
            <a href=""
            {{-- <a href="{{ route('auth.google') }}" --}}
                class="flex items-center justify-center gap-2 px-4 py-2 text-sm text-gray-600 border border-gray-300 rounded-lg bg-slate-100 dark:bg-slate-100 hover:bg-white dark:hover:bg-white transition">
                <svg class="w-5 h-5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"
                        fill="#4285F4" />
                    <path
                        d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"
                        fill="#34A853" />
                    <path
                        d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"
                        fill="#FBBC05" />
                    <path
                        d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"
                        fill="#EA4335" />
                </svg>
                Continue with Google
            </a>
        </div>
        <div class="text-sm text-center mt-5">
            <span class="text-slate-900 dark:text-slate-200">Don't have an account? </span>
            <a href="{{ route('register') }}" class="text-purple-600 hover:underline">
                Sign Up
            </a>
        </div>
    </div>
</x-guest-layout>