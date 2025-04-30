@extends('layouts.auth.app')

@section('title', 'Detalle de Usuario')

@section('content')
    @component('components.login.header')
        @slot('title', 'Detalle de Usuario')
        @slot('subtitle')
            <span class="fs-5">Información completa del usuario</span>
        @endslot
    @endcomponent

    <hr class="my-4">

    <h5>Adjuntar Foto</h5>
    <form action="{{ route('usuarios.foto', $usuario->idUsuario) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <input type="file" name="foto" class="form-control" accept="image/*" required>
        </div>
        <button type="submit" class="btn btn-primary">Subir Foto</button>
    </form>

    @if ($usuario->usuarioFoto)
        <div class="mt-4">
            <h6>Foto actual:</h6>
            <img src="{{ asset('storage/' . $usuario->usuarioFoto) }}" class="img-thumbnail" width="200">
        </div>
    @endif

    <div class="mt-4">
        <ul class="list-group">
            <li class="list-group-item"><strong>Nombre:</strong> {{ $usuario->usuarioNombre }}</li>
            <li class="list-group-item"><strong>Alias:</strong> {{ $usuario->usuarioAlias }}</li>
            <li class="list-group-item"><strong>Email:</strong> {{ $usuario->usuarioEmail }}</li>
            <li class="list-group-item"><strong>Estado:</strong> {{ $usuario->usuarioEstado }}</li>
            <li class="list-group-item"><strong>Última Conexión:</strong> {{ $usuario->usuarioUltimaConexion }}</li>
        </ul>

        <a href="{{ route('usuarios.catalogo') }}" class="btn btn-secondary mt-3">Volver al catálogo</a>
    </div>
@endsection
