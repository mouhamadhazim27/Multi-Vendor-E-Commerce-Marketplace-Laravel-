<x-vendor.layout>
    <div class="container-fluid">
        <div class="row">

            <!-- Sidebar -->
            <x-vendor.sidebar />



            <!-- Main Content -->
            <div class="col-lg-10 col-md-9 p-4">

                <div class="card shadow-sm p-4" style="max-width:500px;margin:auto;border-radius:10px;">

                    ```
                    <h4 style="margin-bottom:20px;">Add Category to Product</h4>

                    <form action="{{ route('vendor.addCatProd', $products->id) }}" method="POST">
                        @csrf

                        <div style="margin-bottom:15px;">
                            <label style="font-weight:600;">Select Category</label>

                            <select name="category_id"
                                style="width:100%;padding:8px;border-radius:6px;border:1px solid #ccc;">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">
                                        {{ $category->category_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit"
                            style="background:#4CAF50;color:white;padding:8px 16px;border:none;border-radius:6px;cursor:pointer;">
                            Add Category
                        </button>
                    </form>

                    <hr style="margin:20px 0;">

                    <h5>Product Categories</h5>

                    @forelse ($products->categories as $category)
                        <span
                            style="display:inline-block; background:#f1f1f1; padding:5px 10px; border-radius:20px; margin:4px; font-size:14px;">
                            {{ $category->category_name }} 
                        </span>
                        
                    @empty
                        <p style="color:#888;">No categories yet</p>
                    @endforelse
                    ```
                    @if(session('error'))
                    <p class="text-danger">
                        {{session('error')}}
                    </p>
                    @endif

                </div>

                <form action="{{route('vendor.editProductAction' , $products->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="container mt-4">
                        <div class="card shadow">
                            <div class="card-header bg-primary text-white">
                                <h4 class="mb-0">Edit Product</h4>
                            </div>

                            <div class="card-body">
                                <!-- Display validation errors -->
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul class="mb-0">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <!-- Product Name -->
                                <div class="mb-3">
                                    <label for="product_name" class="form-label">Product Name <span
                                            class="text-danger">*</span></label>
                                    <input type="text"
                                        class="form-control @error('product_name') is-invalid @enderror"
                                        id="product_name" name="product_name"
                                        value="{{ old('product_name', $products->product_name) }}" required>
                                    @error('product_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Description -->
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description <span
                                            class="text-danger">*</span></label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                                        rows="4">{{ old('description', $products->description) }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Price -->
                                <div class="mb-3">
                                    <label for="price" class="form-label">Price ($) <span
                                            class="text-danger">*</span></label>
                                    <input type="number" step="0.01"
                                        class="form-control @error('price') is-invalid @enderror" id="price"
                                        name="price" value="{{ old('price', $products->price) }}" required>
                                   
                                </div>

                                <!-- Quantity in Stock -->
                                <div class="mb-3">
                                    <label for="quantity_in_stock" class="form-label">Quantity in Stock <span
                                            class="text-danger">*</span></label>
                                    <input type="number"
                                        class="form-control @error('quantity_in_stock') is-invalid @enderror"
                                        id="quantity_in_stock" name="quantity_in_stock"
                                        value="{{ old('quantity_in_stock', $products->quantity_in_stock) }}">
                                    @error('quantity_in_stock')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Product Image -->
                                <div class="mb-3">
                                    <img src="/assets/images/products/{{ $products->image_product }}" width="100px">
                                    <label for="image_product" class="form-label">Product Image</label>
                                    <input type="file"
                                        class="form-control @error('image_product') is-invalid @enderror"
                                        id="image_product" name="image_product" accept="image/*">
                                    @error('image_product')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Accepted formats: JPEG, PNG, JPG, GIF (Max: 2MB)</small>
                                </div>




                            </div>

                            <div class="card-footer text-end">

                                <button type="submit" class="btn btn-success">
                                    <i class="bi bi-save"></i> Edit Product
                                </button>
                            </div>
                            @if (session('success'))
                                <div class="alert alert-success" style="width: 400px; margin:20px" role="alert">
                                    {{ session('success') }}
                                </div>
                            @endif
                        </div>
                    </div>
                </form>



            </div>





        </div>
    </div>
</x-vendor.layout>
