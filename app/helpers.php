<?php

use Jenssegers\Blade\Blade;
use Psr\Http\Message\ResponseInterface as Response;

if (!function_exists('view')) {
    function view(Response $response, string $template, array $with = []): Response
    {
        $cache = __DIR__ . '/../cache'; // Define the path to the cache directory
        $views = __DIR__ . '/../resources/views'; // Define the path to the views directory

        $blade = new Blade($views, $cache); // Create a new Blade instance with specified views and cache directories
        $view = $blade->make($template, $with); // Render the specified template with provided data
        $response->getBody()->write($view->render()); // Write the rendered view content to the response body

        return $response; // Return the response
    }
}
