@extends('layouts.app')

@section('header')
    <nav class="menu">
        <a href="/">Home</a> <!-- Link to the home page -->
        <a href="/login">Login</a> <!-- Link to the login page -->
        <a href="/register">Register</a> <!-- Link to the registration page -->
        <a href="/posts/create">Create Post</a> <!-- Link to the create post page -->
    </nav>
@endsection

@section('content') // Start the content section
    <h1>All Posts</h1> <!-- Header for the posts section -->

    @if(count($posts) > 0) // Check if there are any posts
        <ul>
            @foreach ($posts as $post) // Loop through each post
                <li>
                    <h2><a href="/posts/{{ $post['id'] }}">{{ $post['title'] }}</a></h2> <!-- Link to the post detail page with the post title -->
                    <p>{{ substr($post['content'], 0, 150) }}</p> <!-- Display a snippet of the post content -->
                    <p>Posted on {{ $post['created_at'] }}</p> <!-- Display the post creation date -->
                </li>
            @endforeach
        </ul>
    @else
        <p>No posts available.</p> <!-- Message if no posts are available -->
    @endif

@endsection <!-- End the content section -->
