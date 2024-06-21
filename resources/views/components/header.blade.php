<header>
    <div class="container">
        <nav class="navbar navbar-expand-lg bg-light">
            <div class="container-fluid align-items-end">
                <a class="navbar-brand w-25" href="{{ url('/') }}">
                    <img src="{{ asset('images/logo.png') }}" class="w-100" alt="stelarlink">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between" id="navbarSupportedContent">
                    {{-- MENU COMPONENT --}}
                    <x-menu></x-menu>
                </div>
            </div>
        </nav>
    </div>
</header>
