<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class SetupProductsDirectory extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'setup:products-directory';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Créer et configurer le dossier products avec les bonnes permissions';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $productImagesPath = public_path('images/products');
        
        $this->info("Configuration du dossier products...");
        $this->info("Chemin: " . $productImagesPath);
        
        // Vérifier si le dossier existe
        if (!File::exists($productImagesPath)) {
            $this->info("Création du dossier...");
            
            try {
                // Créer le dossier avec les permissions appropriées
                File::makeDirectory($productImagesPath, 0755, true);
                $this->info("✓ Dossier créé avec succès");
            } catch (\Exception $e) {
                $this->error("✗ Erreur lors de la création du dossier: " . $e->getMessage());
                return 1;
            }
        } else {
            $this->info("✓ Le dossier existe déjà");
        }
        
        // Vérifier les permissions
        $permissions = substr(sprintf('%o', fileperms($productImagesPath)), -4);
        $this->info("Permissions actuelles: " . $permissions);
        
        // Vérifier si le dossier est accessible en écriture
        if (is_writable($productImagesPath)) {
            $this->info("✓ Le dossier est accessible en écriture");
        } else {
            $this->warn("⚠ Le dossier n'est pas accessible en écriture");
            
            // Essayer de corriger les permissions
            try {
                chmod($productImagesPath, 0755);
                $this->info("✓ Permissions corrigées");
            } catch (\Exception $e) {
                $this->error("✗ Impossible de corriger les permissions: " . $e->getMessage());
                $this->comment("Essayez manuellement: sudo chmod -R 755 " . $productImagesPath);
                $this->comment("Et: sudo chown -R www-data:www-data " . $productImagesPath);
            }
        }
        
        // Informations système
        $this->info("\n--- Informations système ---");
        $this->info("Utilisateur PHP: " . (function_exists('posix_getpwuid') && function_exists('posix_geteuid') ? posix_getpwuid(posix_geteuid())['name'] : 'unknown'));
        $this->info("Groupe PHP: " . (function_exists('posix_getgrgid') && function_exists('posix_getegid') ? posix_getgrgid(posix_getegid())['name'] : 'unknown'));
        $this->info("Propriétaire du dossier: " . (function_exists('posix_getpwuid') ? posix_getpwuid(fileowner($productImagesPath))['name'] : 'unknown'));
        
        // Test d'écriture
        $testFile = $productImagesPath . '/test_write.txt';
        $this->info("\n--- Test d'écriture ---");
        
        try {
            file_put_contents($testFile, 'test');
            if (file_exists($testFile)) {
                unlink($testFile);
                $this->info("✓ Test d'écriture réussi");
            }
        } catch (\Exception $e) {
            $this->error("✗ Test d'écriture échoué: " . $e->getMessage());
        }
        
        $this->info("\nConfiguration terminée !");
        
        return 0;
    }
}
