<x-layout>
   <div class="container py-5">
    <div class="row">

        
        <div class="col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-dark text-white">
                    <h5 class="mb-0">Checkout</h5>
                </div>

                <div class="card-body">

                   
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                 
                    @if (empty($cart))
                        <div class="alert alert-warning">
                            Your cart is empty.
                        </div>
                    @else

                    <form action="{{ route('orders.place') }}" method="POST">
                        @csrf

                        <h6 class="mb-3">Your Information</h6>

                        @guest
                        <div class="mb-3">
                            <label class="form-label">Full Name *</label>
                            <input type="text" name="guest_name" class="form-control"
                                   value="{{ old('guest_name') }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email *</label>
                            <input type="email" name="guest_email" class="form-control"
                                   value="{{ old('guest_email') }}" required>
                        </div>
                        @endguest

                        
                        <div class="mb-3">
                            <label class="form-label">Phone *</label>
                            <input type="text" name="phone" class="form-control"
                                   value="{{ old('phone') }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Address *</label>
                            <textarea class="form-control" name="address" rows="3" required>{{ old('address') }}</textarea>
                        </div>

                        <!-- Payment -->
                        <div class="mb-3">
                            <label class="form-label">Payment Method</label>
                            <select name="payment_id" class="form-select" required>
                                @foreach ($paymentMethods as $paymentMethod)
                                    <option value="{{ $paymentMethod->id }}">
                                        {{ $paymentMethod->payment_method }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                      
                        <button type="submit" class="btn btn-primary w-100">
                            Place Order
                        </button>

                    </form>

                    @endif
                </div>
            </div>
        </div>

        <!-- 🛒 Cart Summary -->
        <div class="col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-secondary text-white">
                    <h5 class="mb-0">Your Cart</h5>
                </div>

                <div class="card-body">

                    @php $total = 0; @endphp

                    @forelse ($cart as $item)
                        @php
                            $subtotal = $item['price'] * $item['quantity'];
                            $total += $subtotal;
                        @endphp

                        <div class="d-flex justify-content-between align-items-center mb-3 border-bottom pb-2">
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('assets/images/products/' . $item['image_product']) }}"
                                     width="50" height="50"
                                     class="rounded me-2"
                                     style="object-fit: cover;">
                                <div>
                                    <h6 class="mb-0">{{ $item['product_name'] }}</h6>
                                    <small class="text-muted">Qty: {{ $item['quantity'] }}</small>
                                </div>
                            </div>
                            <span class="fw-bold">${{ $subtotal }}</span>
                        </div>
                    @empty
                        <p class="text-muted">Cart is empty</p>
                    @endforelse

                    <div class="d-flex justify-content-between mt-4">
                        <h5>Total</h5>
                        <h5 class="text-success">${{ $total }}</h5>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>
</x-layout>
