@extends('adminlte::auth.auth-page', ['auth_type' => 'register'])

@php($login_url = View::getSection('login_url') ?? config('adminlte.login_url', 'login'))
@php($register_url = View::getSection('register_url') ?? config('adminlte.register_url', 'register'))

@if (config('adminlte.use_route_url', false))
    @php($login_url = $login_url ? route($login_url) : '')
    @php($register_url = $register_url ? route($register_url) : '')
@else
    @php($login_url = $login_url ? url($login_url) : '')
    @php($register_url = $register_url ? url($register_url) : '')
@endif

@section('auth_header', __('adminlte::adminlte.register_message'))

@section('auth_body')
    <form action="{{ $register_url }}" method="post">
        @csrf

        @error('dni')
            <div class="alert alert-danger">
                <span>La cedula ya esta en uso</span>
            </div>
        @enderror

        @error('password')
            <div class="alert alert-danger">
                <span>Las contraseñas no coinciden</span>
            </div>
        @enderror

        @error('password_confirmation')
            <div class="alert alert-danger">
                <span>Las contraseñas no coinciden</span>
            </div>
        @enderror

        @error('phone')
            <div class="alert alert-danger">
                <span>Error en numero de telefono</span>
            </div>
        @enderror


        {{-- Name field --}}
        <div class="input-group mb-3">
            <input type="text" name="name" required class="form-control @error('name') is-invalid @enderror"
                value="{{ old('name') }}" placeholder="{{ __('adminlte::adminlte.full_name') }}" autofocus>

            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-user {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>

            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="input-group mb-3">
            <input type="number" name="dni" required class="form-control @error('dni') is-invalid @enderror"
                value="{{ old('dni') }}" placeholder="Cedulo / Dni" autofocus>

            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-address-card {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>


        </div>

        {{-- Email field --}}
        <div class="input-group mb-3">
            <input type="email" name="email" required class="form-control @error('email') is-invalid @enderror"
                value="{{ old('email') }}" placeholder="{{ __('adminlte::adminlte.email') }}">

            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        
        {{-- Phone field --}}
        <div class="input-group mb-3">
            <input type="number" name="phone" pattern="[0-9]{1,20}" required class="form-control @error('phone') is-invalid @enderror"
                value="{{ old('phone') }}" placeholder="Numero de telefono" autofocus>

            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-phone {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>
        </div>

        {{-- Address field --}}
        <div class="input-group mb-3">
            <input type="text" name="address" required class="form-control @error('address') is-invalid @enderror"
                value="{{ old('address') }}" placeholder="Direccion">

            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-map-marked-alt {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>

            @error('address')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- Password field --}}
        <div class="input-group mb-3">
            <input type="password" name="password" required class="form-control @error('password') is-invalid @enderror"
                placeholder="{{ __('adminlte::adminlte.password') }}">

            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>
        </div>

        {{-- Confirm password field --}}
        <div class="input-group mb-3">
            <input type="password" required name="password_confirmation"
                class="form-control @error('password_confirmation') is-invalid @enderror"
                placeholder="{{ __('adminlte::adminlte.retype_password') }}">

            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>
        </div>

        {{-- ROL USER --}}
        <input type="text" name="rol" id="rol" value="default" hidden>

        {{-- Register button --}}
        <button type="submit" class="btn btn-block {{ config('adminlte.classes_auth_btn', 'btn-flat btn-primary') }}">
            <span class="fas fa-user-plus"></span>
            {{ __('adminlte::adminlte.register') }}
        </button>

    </form>
@stop

@section('auth_footer')
    <p class="my-0">
        <a href="{{ $login_url }}">
            {{ __('adminlte::adminlte.i_already_have_a_membership') }}
        </a>
    </p>
@stop
