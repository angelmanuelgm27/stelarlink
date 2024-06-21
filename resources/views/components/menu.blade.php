<ul class="navbar-nav menu align-items-end">
    <li class="nav-item">
        <a class="nav-link text-xl work-sans-light py-0 mt-1" aria-current="page" href="{{ route('home') }}">Inicio</a>
    </li>
    <li class="nav-item">
        <a class="nav-link smooth text-xl work-sans-light py-0 mt-1" aria-current="page" href="#coveragemap">Mapa de
            cobertura</a>
    </li>
    <li class="nav-item">
        <a class="nav-link smooth text-xl work-sans-light py-0 mt-1" href="#contact">Contactos</a>
    </li>
    <li class="nav-item">
        <a class="nav-link smooth text-xl work-sans-light py-0 mt-1" href="#prices">Precios</a>
    </li>
    <li class="nav-item">
        <a class="nav-link text-xl work-sans-light py-0 mt-1" href="{{ route('about') }}">Nosotros</a>
    </li>
</ul>

<div class="d-flex gap-2 session">
    @if (Route::has('login'))
        @auth
            <div>
                <x-button text="Ir al panel" :url="route('login')"
                    class="btn btn-primary-secundary px-4  work-sans-regular rounded-pill text-lg"></x-button>
            </div>
        @else
            <div>
                <x-button text="Iniciar sesión" :url="route('login')"
                    class="btn btn-primary-secundary px-4  work-sans-regular rounded-pill text-lg"></x-button>
            </div>

            @if (Route::has('register'))
                <div>
                    <x-button text="Registrate" :url="route('register')"
                        class="btn btn-secondary px-4 rounded-pill work-sans-regular text-lg"></x-button>
                </div>
            @endif
        @endauth
</div>
@endif
</div>
