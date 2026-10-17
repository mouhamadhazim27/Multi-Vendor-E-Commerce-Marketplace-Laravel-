<x-vendor.layout>
    <div class="container-fluid">
        <div class="row">

            <!-- Sidebar -->
            <x-vendor.sidebar />

            <!-- Product Section -->
            @if (session('success'))
                <p class="btn btn-success">{{ session('success') }}</p>
            @endif
            <div class="col-md-9 col-lg-10 ms-sm-auto px-md-4">
                <div class="row mt-4">
                    @forelse ($products as $product)
                        <div class="col-lg-3 col-md-6 mb-4">
                            <div class="card product-card h-100 shadow-sm">
                                <img src="/assets/images/products/{{ $product->image_product }}" class="card-img-top"
                                    alt="{{ $product->product_name }}" style="height: 200px; object-fit: cover;">
                                <div class="card-body d-flex flex-column">
                                    <h6 class="card-title fw-semibold">{{ $product->product_name }}</h6>
                                    <p class="text-muted small mb-2">{{ $product->quantity_in_stock }}</p>
                                    <h6 class="fw-bold text-dark mt-auto mb-3">${{ $product->price }}</h6>
                                    <a href="{{ route('vendor.editproduct', $product->id) }}"
                                        class="btn btn-dark w-100 mt-2">Edit product</a>
                                    <form action="{{ route('vendor.deleteProductAction', $product->id) }}"
                                        method="POST">
                                        @csrf
                                        <input type="submit" class="btn btn-danger w-100 mt-2" value="Delete">
                                    </form>
                                </div>
                            </div>
                        </div>


                    @empty
                        <div class="col-12">
                            <div class="alert alert-info text-center py-4">
                                <i class="bi bi-inbox fs-3 d-block mb-2"></i>
                                No products found
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>

        </div>
    </div>


</x-vendor.layout>
