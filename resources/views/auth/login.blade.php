<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <div class="flex justify-center items-center flex-col w-full max-w-2xl container bg-gray-50 shadow-2xl rounded-2xl mt-40 p-4 md:p-24">
    <form method="POST" action="{{ route('login') }}" class="w-full">
        @csrf
        <div>
            <x-input-label for="email" :value="__('E-Mail')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
        <div class="mt-4">
            <x-input-label for="password" :value="__('Passwort')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password"/>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>
        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('register') }}">
                {{ __('Registrieren?') }}
            </a>
            <x-primary-button class="ms-3">
                {{ __('Einloggen') }}
            </x-primary-button>
        </div>
    </form>

    </div>
</x-guest-layout>
