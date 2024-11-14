@extends('layouts.app')

@section('title', 'Edit Post') <!-- Define the section for the page title -->

@section('content') <!-- Start the content section -->
    <h1>Edit Post</h1>
    <form method="POST" action="/posts/{{ $post['id'] }}">
        @method('PUT') <!-- Use the PUT method for updating the post -->
        @csrf <!-- Include CSRF token for security -->
        
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" value="{{ $post['title'] }}" required> <!-- Input field for the post title with pre-filled value -->

        <label for="content">Content:</label>
        <textarea id="content" name="content" rows="5" required>{{ $post['content'] }}</textarea> <!-- Textarea for the post content with pre-filled value -->

        <button type="submit">Update</button> <!-- Submit button for the form -->
    </form>
@endsection <!-- End of the content section -->
