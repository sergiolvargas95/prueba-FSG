@extends('layouts.auth.app')

@section('title', 'Register')

@section('content')
    @component('components.login.header')
        @slot('title', 'Bienvenido')
        @slot('subtitle')
            <span class="fs-4">Registrarse</span>
        @endslot
    @endcomponent

    <div class="mt-3" id="alertContainer"></div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="w-100 d-flex justify-content-center">
        <div class="card my-5 shadow" style="width: 30%;">
            <div class="card-body">
                <form id="formLogin" method="POST" action="{{ route('register.registerUser') }}" class="my-5">
                    @csrf

                    <label class="input-group mb-3">
                        <input id="usuarioAlias" type="text" class="form-control" name="usuarioAlias" required
                            autocomplete="off" autofocus placeholder="Usuario" aria-label="usuario" aria-describedby="usuario">
                    </label>

                    <label class="input-group mb-3">
                        <input id="usuarioNombre" type="text" class="form-control" name="usuarioNombre" required
                            placeholder="Nombre completo" aria-label="nombre" aria-describedby="nombre">
                    </label>

                    <label class="input-group mb-3">
                        <input id="usuarioEmail" type="email" class="form-control" name="usuarioEmail" required
                            placeholder="Correo electrónico" aria-label="email" aria-describedby="email">
                    </label>

                    <label class="input-group mb-3">
                        <input id="password" type="password" class="form-control" name="usuarioPassword" required
                            placeholder="Contraseña" aria-label="contraseña" aria-describedby="contraseña">
                    </label>

                    <label class="input-group mb-3">
                        <input id="password_confirmation" type="password" class="form-control" name="usuarioPassword_confirmation" required
                            placeholder="Confirmar contraseña" aria-label="confirmar contraseña" aria-describedby="confirmar contraseña">
                    </label>

                    <button type="submit" class="btn btn-dark w-100 mt-3">Registrar</button>
                    <div class="text-center mt-3">
                        <a href="{{ route('login') }}" class="btn btn-outline-secondary w-100">Iniciar sesión</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
