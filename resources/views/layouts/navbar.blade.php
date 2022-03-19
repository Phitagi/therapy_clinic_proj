
    <div class="navbar size-100%">
        @auth
            <a href="{{ route('logout') }}" class="relative left-90 text-md text-black-700">Log out</a>
        @else
            <h2 class='mx-auto'><i><a href="{{ route('/') }}">Therapy Clinic</a></i></h2>
        @endauth
    </div>
