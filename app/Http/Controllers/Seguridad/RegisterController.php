<?php
declare(strict_types=1);

namespace App\Http\Controllers\Seguridad;

use App\Models\Rol;
use App\Models\Seguridad\Usuario;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Seguridad\RegisterUserRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

class RegisterController
{
    public function __construct() {}

    public function register(): View {
        return view('modulos.seguridad.auth.register');
    }

    public function registerUser(RegisterUserRequest $request): JsonResponse {

        $usuario = Usuario::create([
            'usuarioAlias'         => $request->usuarioAlias,
            'usuarioPassword'      => md5($request->usuarioPassword),
            'usuarioNombre'        => $request->usuarioNombre,
            'usuarioEmail'         => $request->usuarioEmail,
            'usuarioEstado'        => 'Activo',
            'usuarioConectado'     => 'N',
            'usuarioUltimaConexion'=> now(),
        ]);

        $rolUsuario = Rol::where('nombreRol', 'Usuario')->orWhere('nombreRol', 'Usuario')->first();

        if ($rolUsuario) {
            $usuario->roles()->attach($rolUsuario->idRol);
        }

        $url = "/seguridad/usuario/catalogo";

        if ($usuario->usuarioEstado == 'Activo' && md5($request->usuarioPassword) == $usuario->usuarioPassword) {
            $usuario->guardarSesion($usuario->idUsuario);

            return response()->json(['success' => true, 'message' => 'Excelente logueo con éxito.', 'url' => $url]);
        } else {
            $mensajes = 'Credenciales incorrectas o el usuario no está activo.';
            return response()->json(['success' => false, 'required' => true, 'message' => ['usuarioAlias' => [$mensajes]]]);
        }
    }
}
