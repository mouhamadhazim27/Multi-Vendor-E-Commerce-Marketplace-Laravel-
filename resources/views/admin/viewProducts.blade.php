<x-admin.layout>

 

    <div class="row mt-2">
        @forelse ($storeProducts as $storeProduct)
            <div class="col-lg-3 col-md-6 mb-2">
                <div class="card product-card h-100 shadow-sm">
                    <img src="/assets/images/products/{{ $storeProduct->image_product }}" class="card-img-top"
                        alt="{{ $storeProduct->product_name }}" style="height: 200px; object-fit: cover;">
                    <div class="card-body d-flex flex-column">
                        <h6 class="card-title fw-semibold">{{ $storeProduct->product_name }}</h6>
                        <p class="text-muted small mb-2">{{ $storeProduct->quantity_in_stock }}</p>
                        <h6 class="fw-bold text-dark mt-auto mb-3">${{ $storeProduct->price }}</h6>
                        <form action="{{ route('admin.deleteProductsVendor', $storeProduct->id) }}" method="POST">
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



</x-admin.layout>
