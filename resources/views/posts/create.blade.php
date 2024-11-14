@extends('layouts.app')

@section('title', 'Create Post') <!-- Define the section for the page title -->

@section('content') <!-- Start the content section -->
    <h1>Create a New Post</h1>
    <form method="POST" action="/posts">
        @csrf <!-- Include CSRF token for security -->
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" required> <!-- Input field for the post title -->

        <label for="content">Content:</label>
        <textarea id="content" name="content" rows="5" required></textarea> <!-- Textarea for the post content -->

        <button type="submit">Publish</button> <!-- Submit button for the form -->
    </form>
@endsection <!-- End of the content section -->
