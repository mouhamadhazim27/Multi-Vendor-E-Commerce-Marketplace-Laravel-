<x-vendor.layout>
    <div class="container-fluid">
        <div class="row">

            <!-- Sidebar -->
            <x-vendor.sidebar />


            <div class="col-md-9 col-lg-10 p-4">

                <h3 class="mb-4">Orders</h3>

                <div class="card shadow-sm border-0">
                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="table table-bordered table-hover align-middle text-center">

                                <thead class="table-dark">
                                    <tr>
                                        <th>#</th>
                                        <th>User</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Address</th>
                                        <th>Product name</th>
                                        <th>Total Price</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse ($orders as $order)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $order->user->name ?? $order->guest_name }}</td>
                                            <td>{{ $order->user->email ?? $order->guest_email }}</td>
                                            <td>{{ $order->phone }}</td>
                                            <td>{{ $order->address }}</td>

                                            {{-- Product names (combined) --}}
                                            <td>
                                                @foreach ($order->items as $item)
                                                    {{ $item->product->product_name }} (x{{ $item->quantity }}- ${{ $item->price * $item->quantity }})<br>
                                                @endforeach
                                            </td>

                                            {{-- Total price of this vendor's items --}}
                                            <td>
                                                ${{ $order->items->sum(function ($item) {
                                                    return $item->price * $item->quantity;
                                                }) }}
                                            </td>

                                            <td>{{$order->payment->payment_method}}</td>
                                            <td><span class="badge bg-success">Completed</span></td>
                                            <td>{{ $order->created_at->format('Y-m-d') }}</td>

                                            <td>
                                                <button class="btn btn-sm btn-primary">View</button>
                                                <button class="btn btn-sm btn-danger">Delete</button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="11">No orders found</td>
                                        </tr>
                                    @endforelse




                                    {{-- <tr>
                                    <td>3</td>
                                    <td><span class="text-muted">Ali Ahmad (Guest)</span></td>
                                    <td>+961 76 555 222</td>
                                    <td>Saida, Lebanon</td>
                                    <td><span class="badge bg-info">Cash</span></td>
                                    <td class="text-success fw-bold">$45</td>
                                    <td><span class="badge bg-danger">Cancelled</span></td>
                                    <td>2026-04-04</td>
                                    <td>
                                        <button class="btn btn-sm btn-primary">View</button>
                                        <button class="btn btn-sm btn-danger">Delete</button>
                                    </td>
                                </tr> --}}

                                </tbody>

                            </table>
                        </div>

                    </div>
                </div>

            </div>

        </div>
    </div>
</x-vendor.layout>
