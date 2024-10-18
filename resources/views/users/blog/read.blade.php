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
                Published By: {{ ($blog->users->name) }}
            </small>
            <br>
            <small class="text-muted">
                Published on: {{ \Carbon\Carbon::parse($blog->created_at)->setTimezone('Asia/Kolkata')->format('d-M-Y h:i A') }}
            </small>
        </p>

        <a href="{{ route('blog') }}" class="btn btn-primary">Back to Blog List</a>
        </div>
    </div>
@endsection
