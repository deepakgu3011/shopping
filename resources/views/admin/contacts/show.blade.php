@extends('layouts.master')

@push('title')
    <title>Contact Details</title>
@endpush

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <!-- Display Contact Details -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h3>Contact Details</h3>
                    </div>
                    <div class="card-body">
                        @if($contact->isEmpty())
                            <p>No contact information found.</p>
                        @else
                            @foreach ($contact as $item)
                                <div class="mb-3">
                                    <p><strong>Name:</strong> {{ $item->name }}</p>
                                    <p><strong>Email:</strong> {{ $item->email }}</p>
                                    <p><strong>Phone:</strong> {{ $item->phone }}</p>
                                    <p><strong>Message:</strong> {{ $item->message }}</p>
                                    <hr>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
