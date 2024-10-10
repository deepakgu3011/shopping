@extends('guests.layouts.master')
@push('title')
    <title>Home</title>
@endpush
@section('content')
    <div class="container mt-3">
        <div class="row">
            @foreach ($products as $product)
                <div class="col-md-4">
                    <div class="card mb-4">
                        <img src="{{ Crypt::decrypt($product->image) }}" class="card-img-top" alt="{{ $product->name }}"      style="width: 100%; aspect-ratio: 16/9; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title"><b>Product Name: <u>{{ ucfirst($product->name) }}</u></b></h5>
                            <p class="card-text"><strong>Category:</strong> {{ Crypt::decrypt($product->category->name) }}
                            </p>
                            <p class="card-text text-justify">
                                <strong>Description: </strong>
                                {{ implode(' ', array_slice(explode(' ', $product->description), 0, 20)) }}{{ count(explode(' ', $product->description)) > 15 ? '...' : '' }}
                            </p>

                            @if (auth()->check())
                            <a href="{{ url(Crypt::decrypt($product->link)) }}" class="btn btn-secondary"
                                onclick="return confirmRedirect('You are about to be redirected to the Amazon website. Do you want to continue?')">
                                Buy Now
                            </a>
                            @else
                               <a href="{{ route('login') }}" class="btn btn-primary">Login to buy</a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <script>
        function confirmRedirect(message) {
            if (confirm(message)) {
                return true;
            } else {
                return false;
            }
        }
    </script>
@endsection
