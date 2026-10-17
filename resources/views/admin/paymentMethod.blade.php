<x-admin.layout>
    <div class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <h2 class="mt-4">ADD PAYMENT METHOD</h2>
       
        <!-- Add your category management interface here -->
        <form action="{{route('admin.paymentMethods.add')}}" method="POST">
            @csrf
            <div class="mb-3 ">
                <label for="paymentMethod" class="form-label">Payment method</label>
                <input type="text" name="payment_method" class="form-control w-50" id="paymentMethod"
                    placeholder="Enter payment method name..." required>
                <input type="submit" class="btn btn-outline-primary mt-2" value="Add payment method">
        </form>
        @error('payment_method')
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
                        @foreach ( $paymentMethods as $paymentMethod)
                            <tr>
                                <td>{{ $paymentMethods->firstItem() + $loop->index }}</td>
                                <td>{{ $paymentMethod->payment_method }}</td>
                                <td class="d-flex flex-column gap-1">
                                    <form action="" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>

        </div>

    </div>
</x-admin.layout>
