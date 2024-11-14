<?php

namespace Await\SlimBlog\Models;

use PDO;

class User
{
    protected $pdo;

    // Constructor to initialize PDO instance
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    // Method to create a new user
    public function create($username, $password)
    {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT); // Hash the password
        $stmt = $this->pdo->prepare("INSERT INTO users (username, password, created_at) VALUES (:username, :password, NOW())"); // Prepare SQL statement
        $stmt->execute(['username' => $username, 'password' => $hashedPassword]); // Execute statement with provided data
        return $this->pdo->lastInsertId(); // Return the ID of the newly created user
    }

    // Method to find a user by username
    public function findByUsername($username)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE username = :username"); // Prepare SQL statement
        $stmt->execute(['username' => $username]); // Execute statement with provided username
        return $stmt->fetch(); // Fetch and return the user data
    }

    // Method to verify password against its hash
    public function verifyPassword($password, $hash)
    {
        return password_verify($password, $hash); // Verify the password against the hash
    }
}
