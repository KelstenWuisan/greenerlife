@extends('layout.main')

@section('container')
<div class="container" style="padding-top: 100px; padding-bottom: 50px;">
    <div class="row">
        <!-- Product Image -->
        <div class="col-md-6">
            <img src="{{ asset($product->image) }}" class="img-fluid rounded shadow-sm" alt="{{ $product->name }}">
        </div>

        <!-- Product Details -->
        <div class="col-md-6">
            <h2>{{ $product->name }}</h2>
            <p class="text-muted">{{ $product->description }}</p>
            <h4 class="text-success">${{ number_format($product->price, 2) }}</h4>

            @if (session('success'))
                <div class="alert alert-success mt-3">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Order Form -->
            <form action="{{ route('order.store') }}" method="POST" class="mt-4">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">

                <div class="mb-3">
                    <label for="quantity" class="form-label">Quantity</label>
                    <input type="number" name="quantity" id="quantity" min="1" value="1" class="form-control w-50" required>
                </div>

                <button type="submit" class="btn btn-success btn-lg">Place Order</button>
            </form>
        </div>
    </div>
</div>
@endsection
