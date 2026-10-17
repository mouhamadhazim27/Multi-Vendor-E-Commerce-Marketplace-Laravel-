<x-admin.layout>
   <div class="row">
    <h3>Vendors</h3>
    @forelse ($stores as $store)
        <div class="col-12 col-sm-6 col-lg-4 mb-4">
            <div class="card h-100 shadow-sm border-0">

                <!-- Store Logo -->
                <div class="text-center p-3 bg-light">
                    <img src="/assets/images/stores/{{ $store->store_logo }}"
                         class="img-fluid rounded"
                         style="max-height: 120px;"
                         alt="Store Logo">
                </div>

                <div class="card-body d-flex flex-column">

                    <!-- Store Name -->
                    <h5 class="card-title mb-1">
                        {{ $store->store_name }} ({{ $store->user->name }})
                    </h5>

                    <!-- Slug -->
                    <p class="text-muted small mb-2">
                        {{ $store->store_slug }}
                    </p>

                    <!-- Store Info -->
                    <ul class="list-unstyled small mb-3">
                        <li><strong>Email:</strong> {{ $store->business_email }}</li>
                        <li><strong>Phone:</strong> {{ $store->phone_number }}</li>
                        <li><strong>Address:</strong> {{ $store->address }}</li>
                    </ul>

                    <!-- Description -->
                    <p class="small text-muted flex-grow-1">
                        {{ Str::limit($store->store_description, 100) }}
                    </p>

                    <!-- Buttons -->
                    <div class="d-grid gap-2">
                        <a href="{{route('admin.viewProductsVendor' , $store->id)}}" class="btn btn-secondary">View Products</a>
                       
                    </div>

                </div>
            </div>
        </div>

    @empty
        <div class="col-12 text-center">
            <p>No stores found.</p>
        </div>
    @endforelse
</div>

<div class="mt-3">
    {{ $stores->links('pagination::bootstrap-5') }}
</div>

</x-admin.layout>
