<?php

namespace Await\SlimBlog\Models;

use PDO;

class Comment
{
    protected $pdo;

    // Constructor to initialize PDO instance
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    // Method to create a new comment
    public function create($userId, $postId, $content)
    {
        $stmt = $this->pdo->prepare("INSERT INTO comments (user_id, post_id, content, created_at) VALUES (:user_id, :post_id, :content, NOW())"); // Prepare SQL statement
        $stmt->execute(['user_id' => $userId, 'post_id' => $postId, 'content' => $content]); // Execute statement with provided data
        return $this->pdo->lastInsertId(); // Return the ID of the newly created comment
    }

    // Method to update an existing comment
    public function update($id, $content)
    {
        $stmt = $this->pdo->prepare("UPDATE comments SET content = :content WHERE id = :id"); // Prepare SQL statement
        return $stmt->execute(['content' => $content, 'id' => $id]); // Execute statement with provided data and return the result
    }

    // Method to delete a comment by ID
    public function delete($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM comments WHERE id = :id"); // Prepare SQL statement
        return $stmt->execute(['id' => $id]); // Execute statement with provided ID and return the result
    }

    // Method to get comments by a specific column value
    public function where($column, $value)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM comments WHERE $column = :value"); // Prepare SQL statement
        $stmt->execute([':value' => $value]); // Execute statement with provided value

        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch all results as an associative array
    }
}
