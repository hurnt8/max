<?php
/*
 * Équivalent de : php artisan view:clear && config:clear && route:clear && cache:clear
 * Utile après un déploiement sur un hébergeur sans SSH, quand un changement de code
 * (ex: routes, blade) ne semble pas pris en compte à cause du cache compilé.
 * À SUPPRIMER après utilisation.
 * Accès : https://aureliscapital.online/clear-cache.php?key=CHANGE_ME
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

echo "=== Nettoyage des caches Laravel ===\n\n";

foreach (['view:clear', 'config:clear', 'route:clear', 'cache:clear'] as $command) {
    echo ">>> php artisan {$command}\n";
    $exitCode = Illuminate\Support\Facades\Artisan::call($command);
    echo Illuminate\Support\Facades\Artisan::output();
    echo ($exitCode === 0 ? "✓ OK" : "✗ Échec (code {$exitCode})") . "\n\n";
}

echo "Terminé — supprimez ce fichier maintenant.\n";
