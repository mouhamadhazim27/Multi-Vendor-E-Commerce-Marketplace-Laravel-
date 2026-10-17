<x-admin.layout>

    <div class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <h2 class="mt-4">Categories Management</h2>
        <p>This is where you can manage product categories. You can add, edit, or delete categories to organize your
            products effectively.</p>
        <!-- Add your category management interface here -->
        <form action="{{ route('category.add') }}" method="POST">
            @csrf
            <div class="mb-3 ">
                <label for="categoryName" class="form-label">Category Name</label>
                <input type="text" name="category_name" class="form-control w-50" id="categoryName"
                    placeholder="Enter category name..." required>
                <input type="submit" class="btn btn-outline-primary mt-2" value="Add Category">
        </form>
        @error('category_name')
            <div class="alert alert-danger mt-2 w-50">{{ $message }}</div>
        @enderror
      
    </div>
    <div class="container-fluid">
          @if (session('success'))
            <div class="alert alert-success w-50 mt-2">{{ session('success') }}</div>
        @endif
        <div class="card p-2 p-md-3 shadow-sm">
            <h5 class="mb-3">Categories</h5>

            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Category name</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <td>{{ $categories->firstItem() + $loop->index }}</td>
                                <td>{{ $category->category_name }}</td>
                                <td class="d-flex flex-column gap-1">
                                    <form action="{{ route('category.delete', $category->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $categories->links('pagination::bootstrap-5') }}

            </div>
        </div>

    </div>
</x-admin.layout>
