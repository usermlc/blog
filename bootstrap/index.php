<?php

declare(strict_types=1);

use DI\Container;
use DI\Bridge\Slim\Bridge as SlimAppFactory;
use Psr\Container\ContainerInterface;
use Await\SlimBlog\Models\Post;

require_once __DIR__ . '/../vendor/autoload.php';

// Create a new container instance
$container = new Container();

// Load settings and configure them in the container
$settings = require_once __DIR__ . '/../app/settings.php';
$settings($container);

// Define the PDO connection service in the container
$container->set(PDO::class, function (ContainerInterface $c) {
    $db = $c->get('settings')['db'];
    $pdo = new PDO("{$db['driver']}:host={$db['host']};dbname={$db['database']}", $db['username'], $db['password']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $pdo;
});

// Create the Slim application with the container
$app = SlimAppFactory::create($container);

// Load and apply middlewares
$middlewares = require_once __DIR__ . '/../app/middlewares.php';
$middlewares($app);

// Load and define routes
$routes = require_once __DIR__ . '/../app/routes.php';
$routes($app);

// Run the Slim application
$app->run();
