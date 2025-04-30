<?php

namespace App\Http\Controllers\Seguridad;

use Illuminate\Http\Request;
use App\Models\Seguridad\Usuario;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class UsuarioController extends Controller
{

    public function catalogo(): View
    {
        $rol = session('usuarioRol');
        $idUsuario = session('idUsuario');

        if ($rol === 'Administrador') {
            $usuarios = Usuario::all();
        } else {
            $usuarios = collect([Usuario::find($idUsuario)]);
        }

        return view('modulos.seguridad.usuario.catalogo', compact('usuarios'));
    }

    public function detalle($id): View
    {
        $usuario = Usuario::findOrFail($id);
        return view('modulos.seguridad.usuario.detalle', compact('usuario'));
    }


    public function guardarFoto(Request $request, $id)
    {
        $request->validate([
            'foto' => 'required|image|max:2048',
        ]);

        $usuario = Usuario::findOrFail($id);

        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('usuarios', 'public');
            $usuario->usuarioFoto = $path;
            $usuario->save();
        }

        return redirect()->route('usuarios.detalle', $id)->with('success', 'Foto actualizada correctamente.');
    }
}
