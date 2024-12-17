<nav class="navbar navbar-expand-lg fixed-top bg-black bg-opacity-50 navbar-custom">
    <div class="container">
        <a class="navbar-brand" href="#">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" style="height: 40px" >
        </a>
        <button 
            class="navbar-toggler" 
            type="button" 
            data-bs-toggle="collapse" 
            data-bs-target="#navbarSupportedContent" 
            aria-controls="navbarSupportedContent" 
            aria-expanded="false" 
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link {{ ($title === 'Home') ? 'active' : '' }}" style="color: #75af48; padding-left: 1rem; padding-right: 1rem; font-size: 20px;" href="/welcome">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ ($title === 'About') ? 'active' : '' }}" style="color: #75af48; padding-left: 1rem; padding-right: 1rem; font-size: 20px;" href="/about">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ ($title === 'Posts') ? 'active' : '' }}" style="color: #75af48; padding-left: 1rem; padding-right: 1rem; font-size: 20px;" href="/posts">Events</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ ($title === 'Donation') ? 'active' : '' }}" style="color: #75af48; padding-left: 1rem; padding-right: 1rem; font-size: 20px;" href="/donate">Donation</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ ($title === 'Challenges') ? 'active' : '' }}" style="color: #75af48; padding-left: 1rem; padding-right: 1rem; font-size: 20px;" href="/challenges">Challenges</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ ($title === 'Products') ? 'active' : '' }}" style="color: #75af48; padding-left: 1rem; padding-right: 1rem; font-size: 20px;" href="/products">Products</a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto">
            @auth
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" style="color: #75af48; padding-left: 1rem; padding-right: rem; font-size: 20px;" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    {{ Auth::user()->name }} <!-- Display the logged-in user's name -->
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown" style="transform: translateX(-20px);">
                    <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Edit Profile</a></li>
                    <li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>
                </ul>
            </li>
            @else
            <li class="nav-item">
                <a class="nav-link" style="color: #75af48; padding-left: 1rem; padding-right: 1rem;" href="{{ route('login') }}">Login</a>
            </li>
            @endauth

        </ul>

        <!-- Logout Form (for POST logout request) -->
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>

        </div>
    </div>
</nav>
