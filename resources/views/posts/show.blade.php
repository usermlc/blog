@extends('layouts.app')

@section('title', $post['title'])

@section('content')
    <h1>{{ $post['title'] }}</h1>
    <p>{{ $post['content'] }}</p>
    <p>Posted on {{ $post['created_at'] }}</p>

    <h2>Comments</h2>
    @if(count($comments) > 0)
        <ul>
            @foreach($comments as $comment)
                <li>
                    <p>{{ $comment['content'] }}</p>
                    <small>By User {{ $comment['user_id'] }} on {{ $comment['created_at'] }}</small>
                </li>
            @endforeach
        </ul>
    @else
        <p>No comments yet.</p>
    @endif

    <h3>Add a Comment</h3>
    <form method="POST" action="/comments">
        <input type="hidden" name="post_id" value="{{ $post['id'] }}">
        <label for="content">Comment:</label>
        <textarea id="content" name="content" rows="3" required></textarea>
        <button type="submit">Submit</button>
    </form>
@endsection
