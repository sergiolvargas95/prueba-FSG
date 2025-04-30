<?php

namespace App\Http\Controllers\Seguridad;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Seguridad\Usuario;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{

    public $modelUsuario;
    public function __construct()
    {
        $this->modelUsuario = new Usuario();
    }

    public function login($url = null): View
    {
        return view('modulos.seguridad.auth.login', ['url' => $url, 'mensajes' => array()]);
    }

    public function showPasswordReset()
    {
        return view('modulos.seguridad.auth.recuperar');
    }

    public function verifyCodeForm(Request $request)
    {
        return view('modulos.seguridad.auth.verify-code');
    }

    public function acceso(Request $request)
    {

        if ($request->isMethod('post')) {
            if ($request->ajax()) {

                $validator = Validator::make(
                    $request->all(),
                    [
                        'usuarioAlias' => 'required',
                        'usuarioPassword' => 'required'
                    ],
                    [
                        'usuarioAlias.required' => 'El campo usuario es requerido.',
                        'usuarioPassword.required' => 'El campo contraseña es requerido.'
                    ]
                );
                if ($validator->fails()) {
                    $message  = $validator->errors()->toArray();
                    return response()->json(['success' => false, 'message' => $message, 'required' => true]);
                }

                $usuarioAlias    = $request->usuarioAlias;
                $usuarioPassword = $request->usuarioPassword;
                $url             = "/seguridad/usuario/catalogo";

                $bandera = true;
                $mensajes = [];
                $modeloUsuario = $this->modelUsuario;
                $usuario       = $modeloUsuario->obtenerUsuario($usuarioAlias);

                if ($usuario) {
                    //Bloqueo
                    if ($usuario->usuarioEstado == "Bloqueado") {
                        $bandera = false;
                        $mensajes = "Usuario Bloqueado, Favor de Verificar";
                    } else if ($usuario->usuarioEstado == "Inactivo" || $usuario->usuarioEstado == "Desactivado") {
                        $bandera = false;
                        $mensajes = "Usuario Inválido " . $usuarioAlias . ", Favor de Verificar";
                    } else {
                        //Password
                        if (md5($usuarioPassword) != $usuario->usuarioPassword) {
                            $bandera = false;
                            $mensajes = "Credenciales Invalidas, Favor de Verificar($usuario->usuarioIntentos)";
                        }
                    }
                } else {

                    $bandera = false;
                    $mensajes = "Correo electrónico o contraseña incorrectos";
                }

                if ($bandera) {
                    $modeloUsuario->guardarSesion($usuario->idUsuario);

                    $rol = $usuario->roles()->pluck('nombreRol')->first();

                    session([
                        'idUsuario'     => $usuario->idUsuario,
                        'usuarioAlias'  => $usuario->usuarioAlias,
                        'usuarioNombre' => $usuario->usuarioNombre,
                        'usuarioRol'    => $rol,
                        'usuarioAutenticado' => true
                    ]);

                    return response()->json(['success' => true, 'message' => 'Excelente logueo con éxito.', 'url' => $url]);
                } else {
                    return response()->json(['success' => false, 'required' => true, 'message' => ['usuarioAlias' => [$mensajes]]]);
                }
            }
        }
    }

    public function sendPasswordReset(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:seg_usuario,usuarioEmail',
        ], [
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El correo electrónico debe ser válido.',
            'email.exists' => 'El correo electrónico proporcionado no está registrado en nuestro sistema.',
        ]);

        $code = rand(100000, 999999);

        DB::table('password_resets')->updateOrInsert(
            ['email' => $request->email],
            ['token' => $code, 'created_at' => Carbon::now()]
        );

        $url = url('seguridad/auth/verificar-codigo?email=' . urlencode($request->email) . '&code=' . $code);

        Mail::raw("Tu código de verificación es: $code\n\nPuedes ingresar directamente desde aquí:\n$url", function ($message) use ($request) {
            $message->from('noreply@tudominio.com', 'Prueba Four Sides Group');
            $message->to($request->email)->subject('Recuperación de contraseña');
        });

        return back()->with('success', 'Te hemos enviado un correo con instrucciones para restablecer tu contraseña.');
    }

    public function logout()
    {
        $idUsuario = session('idUsuario');
        if ($idUsuario) {
            $usuario = Usuario::find($idUsuario);
            if ($usuario) {
                $usuario->usuarioConectado = 0;
                $usuario->save();
            }
        }
        session()->flush();
        return redirect('/');
    }

    public function verifyCode(Request $request)
{
    $request->validate([
        'email' => 'required|email|exists:seg_usuario,usuarioEmail',
        'code' => 'required|digits:6',
        'password' => 'required|confirmed|min:6',
    ]);

    $record = DB::table('password_resets')
        ->where('email', $request->email)
        ->where('token', $request->code)
        ->first();

    if (!$record) {
        return back()->withErrors(['token' => 'Código incorrecto o expirado.']);
    }

    DB::table('seg_usuario')
        ->where('usuarioEmail', $request->email)
        ->update(['usuarioPassword' => md5($request->password)]);

    DB::table('password_resets')->where('email', $request->email)->delete();

    return redirect()->route('login')->with('success', 'Contraseña actualizada correctamente.');
}

}
