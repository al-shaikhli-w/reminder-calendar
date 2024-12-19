<nav class="container p-4 flex justify-between items-center">
    <h1 class="uppercase text-2xl">
        <a href="{{route("home")}}">
        Reminder Calendar
        </a>
    </h1>
    <ul class="flex justify-center items-center gap-2 md:gap-5">


        @auth
            <p>Welcome, {{ Auth::user()->name }}!</p>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button onclick="event.preventDefault(); this.closest('form').submit();">
                    {{ __('Log Out') }}
                </button>
            </form>
        @endauth
        @guest
            <a href="{{route("login")}}">Login</a>
            @endguest
    </ul>
</nav>
