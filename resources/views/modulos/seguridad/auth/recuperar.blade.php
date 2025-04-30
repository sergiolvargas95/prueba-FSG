@extends('layouts.auth.app')

@section('title', 'Recuperar contraseña')

@section('content')
    @component('components.login.header')
        @slot('title', '¿Olvidaste tu contraseña?')
        @slot('subtitle')
            <span class="fs-5">Ingresa tu correo electrónico</span>
        @endslot
    @endcomponent

    <div class="w-100 d-flex justify-content-center">
        <form method="POST" action="{{ route('password.email') }}" class="card p-4 my-5" style="width: 50%;">
            @csrf

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @error('email')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="mb-3">
                <label for="email" class="form-label">Correo electrónico</label>
                <input id="email" type="email" class="form-control" name="email" required autofocus>
            </div>

            <button type="submit" class="btn btn-dark w-100">Enviar enlace</button>
        </form>
    </div>
@endsection
