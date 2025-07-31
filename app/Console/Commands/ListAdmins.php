<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class ListAdmins extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:list-admins';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Lister tous les utilisateurs administrateurs';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $admins = User::where('is_admin', true)->get(['id', 'name', 'email', 'created_at']);
        
        if ($admins->isEmpty()) {
            $this->warn('Aucun administrateur trouvé.');
            return 0;
        }
        
        $this->info('👨‍💼 Liste des administrateurs:');
        $this->line('');
        
        $headers = ['ID', 'Nom', 'Email', 'Créé le'];
        $rows = $admins->map(function ($user) {
            return [
                $user->id,
                $user->name,
                $user->email,
                $user->created_at->format('d/m/Y H:i')
            ];
        })->toArray();
        
        $this->table($headers, $rows);
        
        $this->line('');
        $this->info("Total: {$admins->count()} administrateur(s)");
        
        return 0;
    }
}
