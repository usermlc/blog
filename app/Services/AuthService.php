<?php

namespace Await\SlimBlog\Services;

use Await\SlimBlog\Models\User;

class AuthService
{
    private $user;

    // Constructor to initialize User model
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    // Method to register a new user
    public function register($username, $password)
    {
        return $this->user->create($username, $password); // Delegate user creation to the User model
    }

    // Method to authenticate a user
    public function login($username, $password)
    {
        $user = $this->user->findByUsername($username); // Find the user by username
        if ($user && $this->user->verifyPassword($password, $user['password'])) { // Verify the password
            return $user; // Return the user if authentication is successful
        }
        return null; // Return null if authentication fails
    }
}
