<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class MakeUserAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:make-admin {email : L\'email de l\'utilisateur} {--remove : Retirer les droits admin}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Rendre un utilisateur administrateur ou lui retirer les droits admin';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->argument('email');
        $remove = $this->option('remove');
        
        $user = User::where('email', $email)->first();
        
        if (!$user) {
            $this->error("Aucun utilisateur trouvé avec l'email: {$email}");
            return 1;
        }
        
        if ($remove) {
            $user->update(['is_admin' => false]);
            $this->info("✅ Droits admin retirés à l'utilisateur: {$user->name} ({$user->email})");
        } else {
            $user->update(['is_admin' => true]);
            $this->info("✅ L'utilisateur {$user->name} ({$user->email}) est maintenant administrateur");
        }
        
        return 0;
    }
}
