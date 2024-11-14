<?php

use Slim\App;

return function (App $app) {
    $settings = $app->getContainer()->get('settings'); // Retrieve the settings from the container

    // Add error middleware to the application
    $app->addErrorMiddleware(
        $settings['displayErrorDetails'], // Whether to display error details
        $settings['logErrors'], // Whether to log errors
        $settings['logErrorDetails'], // Whether to log detailed error information
    );
};
