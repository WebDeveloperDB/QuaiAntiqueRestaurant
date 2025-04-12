<?php

use Symfony\Component\Dotenv\Dotenv;

require_once dirname(__DIR__) . '/vendor/autoload.php';

if (file_exists(dirname(__DIR__) . '/config/bootstrap.php')) {
    require_once dirname(__DIR__) . '/config/bootstrap.php';
} elseif (method_exists(Dotenv::class, 'bootEnv')) {
    (new Dotenv())->bootEnv(dirname(__DIR__) . '/.env');

    // Charger également les variables de test si elles existent
    if (file_exists(dirname(__DIR__) . '/.env.test')) {
        (new Dotenv())->loadEnv(dirname(__DIR__) . '/.env.test');
    }
}
