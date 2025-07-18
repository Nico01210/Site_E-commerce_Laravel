<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

// Test de l'URL problématique
$request = Illuminate\Http\Request::create('/produit/4', 'GET');
$request->headers->set('Accept', 'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8');

$response = $kernel->handle($request);

echo "Status Code: " . $response->getStatusCode() . "\n";
echo "Content-Type: " . $response->headers->get('Content-Type') . "\n";
echo "Is JSON: " . (strpos($response->getContent(), '{"id":') !== false ? 'YES' : 'NO') . "\n";
echo "Is HTML: " . (strpos($response->getContent(), '<!DOCTYPE html') !== false ? 'YES' : 'NO') . "\n";

if (strpos($response->getContent(), '{"id":') !== false) {
    echo "First 100 chars: " . substr($response->getContent(), 0, 100) . "\n";
} else {
    echo "Page title found: " . (preg_match('/<title>(.*?)<\/title>/', $response->getContent(), $matches) ? $matches[1] : 'NO TITLE') . "\n";
}
