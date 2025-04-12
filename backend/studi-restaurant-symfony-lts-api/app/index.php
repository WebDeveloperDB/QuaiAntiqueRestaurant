<?php

use Symfony\Component\Dotenv\Dotenv;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\KernelInterface;
use MongoDB\Client;

require_once __DIR__ . '/vendor/autoload.php'; // Correction du require_once

// Charger les variables d'environnement
(new Dotenv())->bootEnv(dirname(__DIR__) . '/.env.local');

// Connexion PostgreSQL
$dsn = 'pgsql:host=db;port=5433;dbname=restaurant';
$user = getenv('POSTGRES_USER') ?: 'bajram';
$password = getenv('POSTGRES_PASSWORD') ?: 'Vfbstuttgart';

try {
    $pdo = new PDO($dsn, $user, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
    $postgres_status = "Connexion PostgreSQL réussie !";
} catch (PDOException $e) {
    $postgres_status = "Erreur PostgreSQL : " . $e->getMessage();
}

// Connexion MongoDB
try {
    $mongoClient = new Client(getenv('MONGODB_URL'));
    $database = $mongoClient->selectDatabase(getenv('MONGODB_DATABASE'));
    $mongo_status = "Connexion MongoDB réussie !";
} catch (\Exception $e) {
    $mongo_status = "Erreur MongoDB : " . $e->getMessage();
}

// Réponse JSON
$response = new JsonResponse([
    'postgres_status' => $postgres_status,
    'mongo_status' => $mongo_status
]);

$response->send();
