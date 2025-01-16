<header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

        <a href="{{ route('home') }}" class="logo me-auto"><img src="{{ asset('assets/img/logo1.png') }}"
                alt=""></a>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <h1 class="logo me-auto"><a href="{{ route('home') }}">Medicio</a></h1> -->

        <nav id="navbar" class="navbar order-last order-lg-0">
            <ul>
                @if (Route::has('login'))
                    @auth
                        <li><a class="nav-link scrollto {{ Request::routeIs('home') ? 'active' : '' }}"
                            href="{{ route('home') }}">Home</a></li>
                    @else
                        <li><a class="nav-link scrollto {{ Request::routeIs('homeGuest') ? 'active' : '' }}"
                            href="{{ route('homeGuest') }}">Home</a></li>
                    @endauth
                @endif

                <li><a class="nav-link {{ Request::routeIs('about') ? 'active' : '' }}"
                        href="{{ route('about') }}">About</a></li>
                <li><a class="nav-link {{ Request::routeIs('services') ? 'active' : '' }}"
                        href="{{ route('services') }}">Services</a></li>
                <li><a class="nav-link {{ Request::routeIs('doctors') ? 'active' : '' }}"
                        href="{{ route('doctors') }}">Doctors</a></li>
                <li><a class="nav-link {{ Request::routeIs('contact') ? 'active' : '' }}"
                        href="{{ route('contact') }}">Contact</a></li>
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav><!-- .navbar -->

        @if (Route::has('login'))
            @auth
            <a href="{{ route('appointment') }}" class="appointment-btn"><span class="d-none d-md-inline">Make an</span>
                Appointment</a>
                <x-app-layout>
                </x-app-layout>
            @else
                <a href="{{ route('login') }}" class="appointment-btn"><span
                        class="d-none d-md-inline">Login/</span>Register</a>
            @endauth
        @endif
    </div>
</header>
