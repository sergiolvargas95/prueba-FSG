@extends('layouts.auth.app')

@section('title', 'Verificar código')

@section('content')
    @component('components.login.header')
        @slot('title', 'Verificar código de recuperación')
        @slot('subtitle')
            <span class="fs-5">Ingresa el código enviado a tu correo y establece una nueva contraseña</span>
        @endslot
    @endcomponent

    <div class="w-100 d-flex justify-content-center">
        <form method="POST" action="{{ route('password.verify.code') }}" class="card p-4 my-5" style="width: 50%;">
            @csrf

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            @error('email')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            @error('code')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            @error('password')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="mb-3">
                <label for="email" class="form-label">Correo electrónico</label>
                <input id="email" type="email" class="form-control" name="email" value="{{ request('email') }}" required readonly>
            </div>

            <div class="mb-3">
                <label for="code" class="form-label">Código de verificación</label>
                <input id="code" type="text" class="form-control" name="code" value="{{ request('code') }}" maxlength="6" required readonly>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Nueva contraseña</label>
                <input id="password" type="password" class="form-control" name="password" required>
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirmar contraseña</label>
                <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required>
            </div>

            <div class="d-flex gap-2 mt-3">
                <button type="submit" class="btn btn-dark w-50">Cambiar contraseña</button>
                <a href="{{ route('login') }}" class="btn btn-outline-secondary w-50">Cancelar</a>
            </div>
        </form>
    </div>
@endsection
