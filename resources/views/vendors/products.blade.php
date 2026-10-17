<x-vendor.layout>
    <div class="container-fluid">
        <div class="row">

            <!-- Sidebar -->
            <x-vendor.sidebar />



            <!-- Main Content -->
            <div class="col-lg-10 col-md-9 p-4">

                <!-- Stats Section -->
               
              



                <form action="{{ route('vendor.addProductCat') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="container mt-4">
                        <div class="card shadow">
                            <div class="card-header bg-primary text-white">
                                <h4 class="mb-0">Add Product</h4>
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
                                        id="product_name" name="product_name" value="{{ old('product_name') }}"
                                        required>
                                    @error('product_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Description -->
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description <span
                                            class="text-danger">*</span></label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                                        rows="4"></textarea>
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
                                        name="price" value="{{ old('price') }}" required>
                                    @error('price')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Quantity in Stock -->
                                <div class="mb-3">
                                    <label for="quantity_in_stock" class="form-label">Quantity in Stock <span
                                            class="text-danger">*</span></label>
                                    <input type="number"
                                        class="form-control @error('quantity_in_stock') is-invalid @enderror"
                                        id="quantity_in_stock" name="quantity_in_stock"
                                        value="{{ old('quantity_in_stock') }}">
                                    @error('quantity_in_stock')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Product Image -->
                                <div class="mb-3">
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
                                    <i class="bi bi-save"></i> Save Product
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



                <!-- Orders Table -->


            </div>
        </div>
    </div>



</x-vendor.layout>
