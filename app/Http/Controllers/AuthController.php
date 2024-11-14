<?php

namespace Await\SlimBlog\Http\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Await\SlimBlog\Models\User;
use Await\SlimBlog\Services.AuthService;
use PDO;

class AuthController
{
    private $authService;

    // Constructor to initialize AuthService with User model
    public function __construct(PDO $pdo)
    {
        $userModel = new User($pdo); // Create a new User model instance
        $this->authService = new AuthService($userModel); // Initialize AuthService with User model
    }

    // Method to show the login form
    public function showLoginForm(Request $request, Response $response)
    {
        return view($response, 'auth.login'); // Render the login form view
    }

    // Method to handle login request
    public function login(Request $request, Response $response)
    {
        $data = $request->getParsedBody(); // Get the parsed body of the request
        $user = $this->authService->login($data['username'], $data['password']); // Attempt to login with provided credentials

        if ($user) {
            $_SESSION['user_id'] = $user->id; // Store user ID in session if login is successful
            return $response->withHeader('Location', '/')->withStatus(302); // Redirect to home page
        } else {
            return view($response, 'auth.login', ['error' => 'Invalid credentials']); // Show login form with error message
        }
    }

    // Method to show the registration form
    public function showRegistrationForm(Request $request, Response $response)
    {
        return view($response, 'auth.register'); // Render the registration form view
    }

    // Method to handle registration request
    public function register(Request $request, Response $response)
    {
        $data = $request->getParsedBody(); // Get the parsed body of the request
        $this->authService->register($data['username'], $data['password']); // Register a new user with provided data
        return $response->withHeader('Location', '/login')->withStatus(302); // Redirect to login page
    }

    // Method to handle logout request
    public function logout(Request $request, Response $response)
    {
        session_destroy(); // Destroy the session
        return $response->withHeader('Location', '/')->withStatus(302); // Redirect to home page
    }
}
