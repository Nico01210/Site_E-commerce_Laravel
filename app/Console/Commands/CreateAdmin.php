<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:create-admin {name} {email} {password}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Créer un nouvel utilisateur administrateur';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');
        $email = $this->argument('email');
        $password = $this->argument('password');
        
        // Vérifier si l'email existe déjà
        if (User::where('email', $email)->exists()) {
            $this->error("Un utilisateur avec cet email existe déjà: {$email}");
            return 1;
        }
        
        // Créer l'utilisateur admin
        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'is_admin' => true,
        ]);
        
        $this->info("✅ Administrateur créé avec succès:");
        $this->line("   Nom: {$user->name}");
        $this->line("   Email: {$user->email}");
        $this->line("   Mot de passe: {$password}");
        $this->line("   Statut: Administrateur");
        
        return 0;
    }
}
