<?php
/*
 * Équivalent de : php artisan db:seed --class=RolesAndPermissionsSeeder
 * Crée (sans écraser) les comptes admin/super-admin par défaut sous le nouveau domaine
 * si le seeder n'a jamais été rejoué en production après le changement de domaine.
 * Sûr à relancer : firstOrCreate() ne touche jamais un compte déjà existant.
 *
 * À SUPPRIMER immédiatement après utilisation (crée des comptes avec mots de passe connus).
 * Accès : https://aureliscapital.online/seed-admin.php?key=CHANGE_ME
 */

header('Content-Type: text/plain; charset=utf-8');

const SECRET_KEY = 'CHANGE_ME'; // remplacez par une valeur aléatoire avant upload

if (($_GET['key'] ?? '') !== SECRET_KEY) {
    http_response_code(403);
    echo "Accès refusé.\n";
    exit;
}

require __DIR__ . '/../vendor/autoload.php';

$app = require __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "=== db:seed --class=RolesAndPermissionsSeeder (équivalent) ===\n\n";

$exitCode = Illuminate\Support\Facades\Artisan::call('db:seed', [
    '--class' => 'RolesAndPermissionsSeeder',
    '--force' => true,
]);

echo Illuminate\Support\Facades\Artisan::output();
echo "\nCode de sortie : $exitCode\n";
echo ($exitCode === 0 ? "✓ Succès" : "✗ Échec") . " — supprimez ce fichier maintenant.\n";
