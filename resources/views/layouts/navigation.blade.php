<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand fs-1 d-flex align-items-center" href="{{ route('home') }}">
            <img src="media/logo.png" alt="" width="64" class="d-inline-block align-text-top me-3">
            DOTA 2
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse fs-3" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('play') ? 'active' : '' }}"
                        href="{{ route('play') }}">Play</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('leaderboard') ? 'active' : '' }}"
                        href="{{ route('leaderboard') }}">Leaderboard</a>
                </li>
                @auth
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('team') ? 'active' : '' }}"
                            href="{{ route('team') }}">Team</a>
                    </li>
                @endauth
            </ul>
            <ul class="navbar-nav ms-auto me-5 mb-2 mb-lg-0">
                @guest
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('login') ? 'active' : '' }}" aria-current="page"
                            href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('register') ? 'active' : '' }}" aria-current="page"
                            href="{{ route('register') }}">Register</a>
                    </li>
                @endguest
                @auth
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="text-danger bg-transparent border-0">Logout</button>
                        </form>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
