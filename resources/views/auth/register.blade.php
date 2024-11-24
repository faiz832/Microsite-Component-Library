@section ('title', 'Register - Microsite Component Library')

<x-guest-layout>
    <h1 class="text-xl tracking-tight font-semibold text-center text-slate-900 dark:text-slate-200 mb-6">
        Sign up to MCLibrary
    </h1>

    <div class="border dark:border-slate-800 rounded-lg bg-white dark:bg-slate-900/30 p-6">
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div class="mb-4">
                <x-text-input id="name" class="block mt-1 w-full p-2 border rounded" type="text"
                    name="name" :value="old('name')" required autofocus autocomplete="name"
                    placeholder="Name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div class="mb-4">
                <x-text-input id="email" class="block mt-1 w-full p-2 border rounded" type="email"
                    name="email" :value="old('email')" required autocomplete="username" placeholder="Email" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mb-4">
                <x-text-input id="password" class="block mt-1 w-full p-2 border rounded" type="password"
                    name="password" required autocomplete="new-password" placeholder="Password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mb-4">
                <x-text-input id="password_confirmation" class="block mt-1 w-full p-2 border rounded"
                    type="password" name="password_confirmation" required autocomplete="new-password"
                    placeholder="Confirm Password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="mb-4">
                <x-primary-button
                    class="w-full justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white dark:text-white bg-slate-900 dark:bg-purple-600 hover:bg-slate-700 dark:hover:bg-purple-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-600 transition">
                    {{ __('Sign Up') }}
                </x-primary-button>
            </div>
            <div class="text-sm text-center mt-5">
                <span class="text-slate-900 dark:text-slate-200">Already have an account? </span>
                <a href="{{ route('login') }}" class="text-purple-600 hover:underline">
                    Sign In
                </a>
            </div>
        </form>
    </div>
</x-guest-layout>
