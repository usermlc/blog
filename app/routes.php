<?php

use Await\SlimBlog\Http\Controllers\AuthController;
use Await\SlimBlog\Http\Controllers\BlogController;
use Await\SlimBlog\Http\Controllers\CommentController;
use Slim\App;

return function (App $app) {
    // Group routes that require user authentication
    $app->group('', function () use ($app) {
        $app->get('/posts/create', [BlogController::class, 'create']); // Route to show the form for creating a new post
        $app->post('/posts', [BlogController::class, 'store']); // Route to store a new post
        $app->get('/posts/{id}/edit', [BlogController::class, 'edit']); // Route to show the form for editing an existing post
        $app->put('/posts/{id}', [BlogController::class, 'update']); // Route to update an existing post
        $app->delete('/posts/{id}', [BlogController::class, 'destroy']); // Route to delete an existing post

        $app->post('/comments', [CommentController::class, 'store']); // Route to store a new comment
        $app->get('/comments/{id}/edit', [CommentController::class, 'edit']); // Route to show the form for editing an existing comment
        $app->put('/comments/{id}', [CommentController::class, 'update']); // Route to update an existing comment
        $app->delete('/comments/{id}', [CommentController::class, 'destroy']); // Route to delete an existing comment
    })->add(function ($request, $response, $next) {
        // Middleware to check if the user is authenticated
        if (!isset($_SESSION['user_id'])) {
            return $response->withHeader('Location', '/login')->withStatus(302); // Redirect to login if not authenticated
        }
        return $next($request, $response); // Proceed to the next middleware/handler
    });

    // Public routes
    $app->get('/', [BlogController::class, 'index']); // Route to display all posts
    $app->get('/login', [AuthController::class, 'showLoginForm']); // Route to show the login form
    $app->post('/login', [AuthController::class, 'login']); // Route to handle login
    $app->get('/register', [AuthController::class, 'showRegistrationForm']); // Route to show the registration form
    $app->post('/register', [AuthController::class, 'register']); // Route to handle registration
    $app->get('/posts/{id}', [BlogController::class, 'show']); // Route to display a specific post
    $app->get('/logout', [AuthController::class, 'logout']); // Route to handle logout
};
