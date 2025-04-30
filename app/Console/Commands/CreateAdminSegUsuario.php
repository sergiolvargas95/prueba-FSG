<?php

namespace App\Console\Commands;

use App\Models\Rol;
use Illuminate\Support\Carbon;
use Illuminate\Console\Command;
use App\Models\Seguridad\Usuario;
use Illuminate\Support\Facades\Hash;

class CreateAdminSegUsuario extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:seg-admin
                            {--alias=admin}
                            {--password=admin123}
                            {--nombre=Administrador}
                            {--email=admin@admin.com}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crea un usuario administrador en la tabla seg_usuario';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $alias = $this->option('alias');
        $password = $this->option('password');
        $nombre = $this->option('nombre');
        $email = $this->option('email');

        if (Usuario::where('usuarioAlias', $alias)->exists()) {
            $this->error("Ya existe un usuario con el alias {$alias}.");
            return;
        }

        $user = Usuario::create([
            'usuarioAlias' => $alias,
            'usuarioPassword' => md5($password),
            'usuarioNombre' => $nombre,
            'usuarioEmail' => $email,
            'usuarioEstado' => 'Activo',
            'usuarioConectado' => 'N',
            'usuarioUltimaConexion' => Carbon::now(),
        ]);

        $this->info("Usuario administrador creado: {$user->usuarioAlias}");

        $rolAdmin = Rol::where('nombreRol', 'Administrador')->first();

        if (!$rolAdmin) {
            $this->warn("No se encontró un rol llamado 'Administrador'. Asignación omitida.");
            return Command::SUCCESS;
        }

        $user->roles()->attach($rolAdmin->idRol);
        $this->info("Rol 'Administrador' asignado correctamente.");

        return Command::SUCCESS;
    }
}
