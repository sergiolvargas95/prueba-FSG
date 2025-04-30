@extends('layouts.auth.app')

@section('title', 'Detalle de Usuario')

@section('content')
    @component('components.login.header')
        @slot('title', 'Detalle de Usuario')
        @slot('subtitle')
            <span class="fs-5">Información completa del usuario</span>
        @endslot
    @endcomponent

    @include('components.common.logout-button')

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-warning alert-dismissible fade show mt-3" role="alert">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
        </div>
    @endif

    <hr class="my-4">

    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalFoto">
        Adjuntar Foto
    </button>

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

        @if (session('usuarioRol') === 'Administrador')
            <a href="{{ route('usuarios.catalogo') }}" class="btn btn-secondary mt-3">Volver al catálogo</a>
        @endif
    </div>
    @include('modulos.seguridad.usuario.partials.modals.modal-foto')
@endsection



@push('javascript')
    <script src="{{ asset('modulos/js/seguridad/auth/users.js') }}"></script>
@endpush
