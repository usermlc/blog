<?php

namespace Await\SlimBlog\Models;

use PDO;

class Post
{
    protected $pdo;

    // Constructor to initialize PDO instance
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    // Method to create a new post
    public function create($data)
    {
        $stmt = $this->pdo->prepare("INSERT INTO posts (user_id, title, content) VALUES (:user_id, :title, :content)"); // Prepare SQL statement
        $stmt->execute([
            ':user_id' => $data['user_id'], // Bind user ID
            ':title' => $data['title'], // Bind post title
            ':content' => $data['content'] // Bind post content
        ]);

        return $this->pdo->lastInsertId(); // Return the ID of the newly created post
    }

    // Method to get all posts
    public function getAll()
    {
        $stmt = $this->pdo->query("SELECT * FROM posts"); // Execute SQL query to get all posts
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch all results as an associative array
    }

    // Method to find a post by ID
    public function find($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM posts WHERE id = :id"); // Prepare SQL statement
        $stmt->execute([':id' => $id]); // Execute statement with provided ID
        $post = $stmt->fetch(PDO::FETCH_ASSOC); // Fetch the post data as an associative array

        if ($post === false) {
            return null; // Return null if no post is found
        }

        return $post; // Return the post data
    }
}
