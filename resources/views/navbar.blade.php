<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('home') }}">LunchMap</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">

            </ul>
            <ul class="navbar-nav">
                @auth
                    <!-- For logged-in users -->
                    @if (auth()->user()->role === 'cafe_owner' || auth()->user()->role === 'user')
                        <li class="nav-item">
                            <a class="btn btn-primary btn-sm me-2 nav-link" href="#" data-bs-toggle="modal"
                                data-bs-target="#addCafeModal">
                                Add Place
                            </a>

                        </li>
                    @endif
                    <!-- My Cafes Custom Dropdown -->

                    <!-- Edit Menu Button for Cafe Owners -->
                    @if (auth()->user()->role === 'cafe_owner')
                        @php
                            $cafes = \App\Models\Cafe::where('id_user', auth()->id())->get();
                        @endphp
                        @foreach ($cafes as $cafe)
                            <li class="nav-item">
                                <a class="btn btn-warning btn-sm nav-link"
                                    href="{{ route('menus.index', ['cafe' => $cafe->id_cafe]) }}">
                                    Edit Menu for {{ $cafe->name }}
                                </a>
                            </li>
                        @endforeach
                    @endif

                    <!-- Logout -->
                    <li class="nav-item">
                        <a class="btn btn-outline-light btn-sm me-2 nav-link">Welcome,
                            {{ auth()->user()->name }}</a>
                    </li>
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm nav-link"
                                style="border: none;">Logout</button>
                        </form>
                    </li>
                @else
                    <!-- For guests -->
                    <li class="nav-item">
                        <a class="btn btn-outline-light btn-sm me-2 nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-success btn-sm nav-link" href="{{ route('register') }}">Register</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
