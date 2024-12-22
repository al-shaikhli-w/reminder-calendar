<nav class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-6 flex justify-between items-center">
    <h1 class="uppercase text-xl flex justify-center items-center">
        <a href="{{route("home")}}">
            <x-logo/> Reminder Calendar
        </a>
    </h1>
    <ul class="flex justify-center items-center gap-2 md:gap-5">
        @auth
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <x-primary-button onclick="event.preventDefault(); this.closest('form').submit();">
                    {{ __('Abmelden') }}
                </x-primary-button>
            </form>
        @endauth
        @guest
            <a href="{{route("login")}}" class="inline-flex items-center px-4 py-2 bg-gray-800 border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                {{ __('Anmelden') }}
            </a>
        @endguest

    </ul>
</nav>
