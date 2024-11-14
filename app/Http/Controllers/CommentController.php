<?php

namespace Await\SlimBlog\Http\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Await\SlimBlog\Models\Comment;

class CommentController
{
    // Method to create a new comment
    public function create(Request $request, Response $response)
    {
        $data = $request->getParsedBody(); // Get the parsed body of the request

        // Create a new comment using the data from the request
        Comment::create([
            'user_id' => $_SESSION['user_id'], // Set the user ID from the session
            'post_id' => $data['post_id'], // Set the post ID from the request data
            'content' => $data['content'] // Set the content from the request data
        ]);

        // Redirect to the post page after creating the comment
        return $response->withHeader('Location', "/posts/{$data['post_id']}")->withStatus(302);
    }

    // Method to update an existing comment
    public function update(Request $request, Response $response, array $args)
    {
        $data = $request->getParsedBody(); // Get the parsed body of the request
        $comment = Comment::findOrFail($args['id']); // Find the comment by ID

        // Check if the current user is authorized to update the comment
        if ($comment->user_id != $_SESSION['user_id']) {
            throw new \Exception('Unauthorized'); // Throw an exception if not authorized
        }

        // Update the comment content with the new data
        $comment->update(['content' => $data['content']]);

        // Redirect to the post page after updating the comment
        return $response->withHeader('Location', "/posts/{$comment->post_id}")->withStatus(302);
    }

    // Method to delete an existing comment
    public function delete(Request $request, Response $response, array $args)
    {
        $comment = Comment::findOrFail($args['id']); // Find the comment by ID

        // Check if the current user is authorized to delete the comment
        if ($comment->user_id != $_SESSION['user_id']) {
            throw new \Exception('Unauthorized'); // Throw an exception if not authorized
        }

        // Delete the comment
        $comment->delete();

        // Redirect to the post page after deleting the comment
        return $response->withHeader('Location', "/posts/{$comment->post_id}")->withStatus(302);
    }
}
