@extends('layouts.app')

@section('title', 'Register') // Define the section for the page title

@section('content') // Start the content section
    <h1>Register</h1>
    <form method="POST" action="/register">
        @csrf // Include CSRF token for security
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required> // Input field for username

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required> // Input field for password

        <button type="submit">Register</button> // Submit button for the form
    </form>
@endsection // End of the content section
