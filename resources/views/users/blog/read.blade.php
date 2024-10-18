@extends('guests.layouts.master')

@push('title')
    <title>{{ Crypt::decrypt($blog->title) }}</title>
@endpush

@section('content')
    <div class="container">
        <div class="responsive">
            <h2>{{ Crypt::decrypt($blog->title) }}</h2>
            <img src="{{ Crypt::decrypt($blog->image) }}" alt="Blog Image" class="img-fluid" height="300px">

            <div class="mt-4" style="text-align: justify;">
                <h5>Blog Description</h5>
                <p>{!! Crypt::decrypt($blog->description) !!}</p>
            </div>

            <p>
                <small class="text-muted">
                    Published By: {{ $blog->users->name }}
                </small>
                <br>
                <small class="text-muted">
                    Published on: {{ \Carbon\Carbon::parse($blog->created_at)->setTimezone('Asia/Kolkata')->format('d-M-Y h:i A') }}
                </small>
            </p>

            <!-- Comments Section -->
            <div class="mt-4">
                <h5>Comments</h5>
                @if($blog->comments->isEmpty())
                    <p>No comments yet. Be the first to comment!</p>
                @else
                    @foreach($blog->comments as $comment)
                        <div class="border p-2 mb-2">
                            <strong>{{ $comment->user->name  ? $comment->user->name :"No Name"}}</strong>
                            <hr>
                            <p>{{ Crypt::decrypt($comment->comment) }}</p>
                            <small class="text-muted">
                                Commented on: {{ \Carbon\Carbon::parse($comment->created_at)->setTimezone('Asia/Kolkata')->format('d-M-Y h:i A') }}
                            </small>
                        </div>
                    @endforeach
                @endif
            </div>

            @if (!auth()->user())
                <div class="d-flex">
                    <form action="{{ route('login') }}" method="get" class="mr-2">
                        @csrf
                        <button type="submit" class="btn btn-primary">Login to Comment</button>
                    </form>
                    <a href="{{ route('blog') }}" class="btn btn-primary">Back to Blog List</a>
                </div>
            @else
                <form action="{{ route('blog.comment', Crypt::encrypt($blog->id)) }}" method="post">
                    @csrf
                    <div class="form-group">
                        <input type="number" name="blog_id" id="blog_id" value="{{ $blog->id }}" hidden>
                        <input type="number" name="user_id" id="user_id" value="{{ auth()->user()->id }}" hidden>
                        <label for="comment">Comment:</label>
                        <textarea class="form-control" id="comment" name="comment" rows="3" required></textarea>
                    </div>
                    <div class="d-flex">
                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                        <a href="{{ route('blog') }}" class="btn btn-primary">Back to Blog List</a>
                    </div>
                </form>
            @endif


        </div>
    </div>
@endsection
