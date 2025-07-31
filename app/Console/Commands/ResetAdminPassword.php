<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class ResetAdminPassword extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:reset-password {email} {password}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Réinitialiser le mot de passe d\'un utilisateur';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->argument('email');
        $password = $this->argument('password');
        
        $user = User::where('email', $email)->first();
        
        if (!$user) {
            $this->error("Aucun utilisateur trouvé avec l'email: {$email}");
            return 1;
        }
        
        $user->update([
            'password' => Hash::make($password)
        ]);
        
        $this->info("✅ Mot de passe réinitialisé pour:");
        $this->line("   Nom: {$user->name}");
        $this->line("   Email: {$user->email}");
        $this->line("   Nouveau mot de passe: {$password}");
        $this->line("   Statut: " . ($user->is_admin ? 'Administrateur' : 'Utilisateur'));
        
        return 0;
    }
}
