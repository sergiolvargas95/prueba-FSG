@extends('layouts.auth.app')

@section('title', 'Login')

@section('content')
    @component('components.login.header')
        @slot('title', 'Bienvenido')
        @slot('subtitle')
            <span class="fs-4">Iniciar sesión</span>
        @endslot
    @endcomponent

    <div class="w-100 d-flex justify-content-center">
        <div class="card my-5 shadow" style="width: 30%;">
            <div class="card-body">
                <div class="mt-3" id="alertContainer"></div>

                <form id="formLogin" method="post" action="{{ route('login.acceso') }}">
                    @csrf
                    <label class="input-group mb-3">
                        <input id="usuarioAlias" type="text" class="form-control" name="usuarioAlias" required
                            autocomplete="off" autofocus placeholder="Usuario" aria-label="usuario" aria-describedby="usuario">
                    </label>
                    <label class="input-group mb-3">
                        <input placeholder="Contraseña" aria-label="contraseña" aria-describedby="Contraseña" id="password"
                            type="password" class="form-control" name="usuarioPassword" required autocomplete="current-password">
                    </label>

                    <button type="submit" class="btn btn-dark w-100 mt-3">Iniciar</button>
                </form>

                <div class="mt-4 text-center">
                    <a href="{{ route('register') }}" class="d-block mb-2">¿No tienes una cuenta? Regístrate</a>
                    <a href="{{ route('password.request') }}">¿Olvidaste tu contraseña?</a>
                </div>
            </div>
        </div>
    </div>
@endsection
