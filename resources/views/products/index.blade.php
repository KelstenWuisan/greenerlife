@extends('layout.main')

@section('container')
<!-- Title Section -->
<div class="text-center" style="padding-top: 100px;"> <!-- Use padding-top instead of margin-top -->
    <h2 class="fw-bold">Eco Green Products</h2>
    <p class="text-muted">Explore our environmentally friendly products!</p>
</div>

<!-- Product Cards Section -->
<div class="d-flex justify-content-center" style="margin-top: 50px;"> <!-- Optional: Adjust product card section margin -->
    <div class="row justify-content-center" style="max-width: 1000px;"> <!-- Limit the max-width of the row -->
        @forelse ($products as $product)
            <div class="col-md-3 mb-4"> <!-- Make the cards smaller -->
                <div class="card h-100 shadow-sm text-center"> <!-- Center align the card content -->
                    <img src="{{ asset($product->image) }}" class="card-img-top" alt="{{ $product->name }}" style="height: 200px; object-fit: cover;"> <!-- Adjust image size -->
                    <div class="card-body d-flex flex-column">
                        <h6 class="card-title">{{ $product->name }}</h6>
                        <p class="card-text text-muted">{{ Str::limit($product->description, 50) }}</p>
                        <strong class="mb-2">${{ number_format($product->price, 2) }}</strong>
                        <a href="{{ url('/products/' . $product->id) }}" class="btn btn-sm btn-primary mt-auto">View Details</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <p class="text-center">No products available.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection
