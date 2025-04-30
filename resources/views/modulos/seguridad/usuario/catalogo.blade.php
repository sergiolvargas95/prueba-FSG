@extends('layouts.auth.app')

@section('title', 'Catálogo de Usuarios')

@section('content')
    @component('components.login.header')
        @slot('title', 'Bienvenido')
        @slot('subtitle')
            <span class="fs-4">Catálogo de usuarios</span>
        @endslot
    @endcomponent

    <div class="mt-4">
        <p class="fw-bold">Hola, {{ session('usuarioNombre') }} ({{ session('usuarioRol') }})</p>

        <table class="table table-bordered table-striped mt-4">
            <thead class="table-dark">
                <tr>
                    <th>Nombre</th>
                    <th>Alias</th>
                    <th>Email</th>
                    @if (session('usuarioRol') === 'Administrador')
                        <th>Estado</th>
                        <th>Acciones</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @forelse ($usuarios as $usuario)
                    <tr>
                        <td>{{ $usuario->usuarioNombre }}</td>
                        <td>{{ $usuario->usuarioAlias }}</td>
                        <td>{{ $usuario->usuarioEmail }}</td>
                        @if (session('usuarioRol') === 'Administrador')
                            <td>{{ $usuario->usuarioEstado }}</td>
                            <td>
                                <a href="{{ route('usuarios.detalle', $usuario->idUsuario) }}" class="btn btn-sm btn-outline-primary">
                                    Ver Detalles
                                </a>
                            </td>
                        @endif
                    </tr>
                @empty
                    <tr>
                        <td colspan="{{ session('usuarioRol') === 'Administrador' ? 4 : 3 }}" class="text-center">
                            No hay usuarios registrados.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
