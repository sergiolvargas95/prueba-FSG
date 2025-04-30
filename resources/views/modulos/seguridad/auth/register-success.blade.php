@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-10 p-6 bg-white rounded shadow-md text-center max-w-md">
    <h1 class="text-2xl font-bold text-green-600 mb-4">¡Registro exitoso!</h1>
    <p class="text-gray-700 mb-6">Tu cuenta ha sido creada correctamente.</p>
    <a href="{{ route('login') }}" class="inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
        Ir al inicio de sesión
    </a>
</div>
@endsection
