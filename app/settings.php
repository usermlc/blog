<?php

use Psr\Container\ContainerInterface;

return function (ContainerInterface $container) {
    // Set application settings in the container
    $container->set('settings', fn() => [
        "displayErrorDetails" => true, // Display error details for debugging
        "logErrors" => true, // Enable error logging
        "logErrorDetails" => true, // Log detailed error information
        "db" => [
            'driver' => 'mysql', // Database driver
            'host' => 'localhost', // Database host
            'database' => 'slim_blog', // Database name
            'username' => '', // Database username
            'password' => '', // Database password
            'charset' => 'utf8', // Character set for the database
            'collation' => 'utf8_unicode_ci', // Collation for the database
            'prefix' => '', // Table prefix for the database
        ],
    ]);

    // Set PDO instance in the container
    $container->set(PDO::class, function (ContainerInterface $c) {
        $settings = $c->get('settings')['db'];
        $dsn = "{$settings['driver']}:host={$settings['host']};dbname={$settings['database']};charset={$settings['charset']}"; // Data Source Name
        return new PDO($dsn, $settings['username'], $settings['password']); // Create and return PDO instance
    });

    // Set Post model in the container
    $container->set(Await\SlimBlog\Models\Post::class, function (ContainerInterface $c) {
        return new Await\SlimBlog\Models\Post($c->get(PDO::class)); // Create and return Post model instance
    });

    // Set HomeController in the container
    $container->set(Await\SlimBlog\Http\Containers\HomeController::class, function (ContainerInterface $c) {
        return new Await\SlimBlog\Http\Containers\HomeController($c->get(Await\SlimBlog\Models\Post::class)); // Create and return HomeController instance
    });
};
