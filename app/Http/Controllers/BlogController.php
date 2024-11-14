<?php

namespace Await\SlimBlog\Http\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Await\SlimBlog\Models\Post;
use Await\SlimBlog\Models\Comment;

class BlogController
{
    protected $postModel;
    protected $commentModel;

    // Constructor to initialize Post and Comment models
    public function __construct(Post $postModel, Comment $commentModel)
    {
        $this->postModel = $postModel;
        $this->commentModel = $commentModel;
    }

    // Method to display all posts
    public function index(Request $request, Response $response)
    {
        $posts = $this->postModel->getAll();

        // Append comments to each post
        foreach ($posts as &$post) {
            $post['comments'] = $this->commentModel->where('post_id', $post['id']);
        }

        return view($response, 'home.index', ['posts' => $posts]); // Render the home.index view with posts
    }

    // Method to show the form for creating a new post
    public function create(Request $request, Response $response)
    {
        return view($response, 'posts.create'); // Render the posts.create view
    }

    // Method to store a new post
    public function store(Request $request, Response $response)
    {
        $data = $request->getParsedBody(); // Get the parsed body of the request
        $postId = $this->postModel->create([
            'user_id' => $_SESSION['user_id'], // Set the user ID from the session
            'title' => $data['title'], // Set the title from the request data
            'content' => $data['content'] // Set the content from the request data
        ]);

        return $response->withHeader('Location', "/posts/{$postId}")->withStatus(302); // Redirect to the new post
    }

    // Method to display a specific post and its comments
    public function show(Request $request, Response $response, array $args)
    {
        $postId = $args['id'];
        $post = $this->postModel->find($postId);
        $comments = $this->commentModel->where('post_id', $postId)->get();

        if ($post) {
            return view($response, 'posts.show', ['post' => $post, 'comments' => $comments]); // Render the posts.show view
        }

        return $response->withStatus(404)->write('Post not found'); // Return 404 if post not found
    }

    // Method to show the form for editing a specific post
    public function edit(Request $request, Response $response, array $args)
    {
        $post = $this->postModel->find($args['id']);
        return view($response, 'posts.edit', ['post' => $post]); // Render the posts.edit view
    }

    // Method to update a specific post
    public function update(Request $request, Response $response, array $args)
    {
        $data = $request->getParsedBody();
        $this->postModel->update($args['id'], [
            'title' => $data['title'], // Update the title
            'content' => $data['content'] // Update the content
        ]);

        return $response->withHeader('Location', "/posts/{$args['id']}")->withStatus(302); // Redirect to the updated post
    }

    // Method to delete a specific post
    public function destroy(Request $request, Response $response, array $args)
    {
        $this->postModel->delete($args['id']); // Delete the post
        return $response->withHeader('Location', '/')->withStatus(302); // Redirect to the home page
    }
}
