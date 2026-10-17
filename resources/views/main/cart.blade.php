<x-layout>
    <div class="container py-5">

        <h2 class="mb-4">🛒 Shopping Cart</h2>

        <div class="row">

            <!-- 🧾 Cart Items -->
            <div class="col-lg-8">
                <div class="card shadow-sm">
                    <div class="card-body">

                        @forelse ($cart as $key => $item)
                            <div id="item{{ $key }}" class="card mb-3 shadow-sm border-0">
                                <div class="card-body">
                                    <div class="row align-items-center">

                                        <!-- Product Image -->
                                        <div class="col-4 col-md-2 text-center">
                                            <img src="{{ asset('assets/images/products/' . $item['image_product']) }}"
                                                class="img-fluid rounded" style="max-height: 80px; object-fit: cover;"
                                                alt="product image">
                                        </div>

                                        <!-- Product Info -->
                                        <div class="col-8 col-md-4">
                                            <h6 class="mb-1 fw-semibold">{{ $item['product_name'] }}</h6>
                                            <small class="text-muted">Category</small>
                                        </div>

                                        <!-- Quantity Controls -->
                                        <div class="col-6 col-md-2 mt-3 mt-md-0">
                                            <div class="input-group input-group-sm justify-content-center">
                                                <button class="btn btn-outline-secondary" type="button"
                                                    onclick="changeQuantity({{ $key }}, 'decrement')">−</button>

                                                <input type="text" id="quantity{{ $key }}"
                                                    class="form-control text-center"
                                                    value="{{ $item['quantity'] ?? 1 }}" readonly
                                                    style="max-width: 50px;">

                                                <button class="btn btn-outline-secondary" type="button"
                                                    onclick="changeQuantity({{ $key }}, 'increment')">+</button>
                                            </div>
                                        </div>

                                        <!-- Price -->
                                        <div class="col-3 col-md-2 text-center mt-3 mt-md-0">
                                            <span id="price{{ $key }}" class="fw-bold text-success">
                                                {{ number_format($item['price'], 2) }}
                                            </span>
                                            <span class="text-muted">USD</span>
                                        </div>

                                        <!-- Remove Button -->
                                        <div class="col-3 col-md-2 text-end mt-3 mt-md-0">

                                            <button class="btn btn-sm btn-outline-danger"
                                                onclick="cartRemove({{ $key }})">
                                                <i class="bi bi-trash"></i> Remove
                                            </button>

                                        </div>

                                    </div>
                                </div>
                            </div>

                        @empty
                            <div class="alert alert-info text-center">
                                Your cart is empty 🛒
                            </div>
                        @endforelse

                    </div>
                </div>
            </div>

            <!-- 🧮 Order Summary -->
            <div class="col-lg-4 mt-4 mt-lg-0">
                <div class="card shadow-sm">
                    <div class="card-body">

                        <h5 class="mb-3">Summary</h5>

                        <!-- ✅ Fix 1: Subtotal shows full cart sum -->
                        <div class="d-flex justify-content-between mb-2">
                            <span>Subtotal</span>
                            <span
                                id="cart-subtotal">${{ number_format(array_sum(array_map(fn($item) => $item['quantity'] * $item['price'], $cart)), 2) }}</span>
                        </div>

                        <hr>


                        <div class="d-flex justify-content-between fw-bold mb-3">
                            <span>Total</span>
                            <span id="cart-total">
                                {{ number_format(array_sum(array_map(fn($item) => $item['quantity'] * $item['price'], $cart)), 2) }}
                            </span>
                            <span class="text-muted">USD</span>
                        </div>

                        <a href="{{ route('checkoutPage') }}" class="btn btn-dark w-100">Proceed to Checkout</a>

                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        function changeQuantity(productId, action) {
            const myHeaders = new Headers();
            myHeaders.append("Content-Type", "application/x-www-form-urlencoded");

            const urlencoded = new URLSearchParams();
            urlencoded.append('_token', "{{ csrf_token() }}");

            const requestOptions = {
                method: "POST",
                headers: myHeaders,
                body: urlencoded
            };

            fetch("/cart/" + action + "/" + productId, requestOptions)
                .then((response) => response.json())
                .then((result) => refreshCart(result, productId, action))
                .catch((error) => console.error(error));
        }

        function refreshCart(result, productId, action) {
            if (result.status == "success") {
                const quan = document.getElementById('quantity' + productId);

                // Update quantity
                quan.value = action === 'increment' ?
                    parseInt(quan.value) + 1 :
                    parseInt(quan.value) - 1;

                // Recalculate total from all items
                let total = 0;
                document.querySelectorAll('[id^="quantity"]').forEach(input => {
                    const id = input.id.replace('quantity', '');
                    const itemPrice = parseFloat(document.getElementById('price' + id).innerText);
                    total += parseInt(input.value) * itemPrice;
                });

                // ✅ Update both subtotal and total
                document.getElementById('cart-subtotal').innerText = '$' + total.toFixed(2);
                document.getElementById('cart-total').innerText = total.toFixed(2);
            } else {
                alert(result.message);
            }
        }

        function cartRemove(productId) {
            const myHeaders = new Headers();
            myHeaders.append("Content-Type", "application/x-www-form-urlencoded");

            const urlencoded = new URLSearchParams();
            urlencoded.append('_token', "{{ csrf_token() }}");

            const requestOptions = {
                method: "POST",
                headers: myHeaders,
                body: urlencoded
            };

            fetch("/cart/remove/" + productId, requestOptions)
                .then((response) => response.json())
                .then((result) => {
                    if (result.status == "success") {
                        // Remove the item from DOM
                        document.getElementById('item' + productId).remove();


                        const remaining = document.querySelectorAll('[id^="quantity"]');
                        if (remaining.length === 0) {
                            location.reload();
                            return;
                        }


                        let total = 0;
                        remaining.forEach(input => {
                            const id = input.id.replace('quantity', '');
                            const itemPrice = parseFloat(document.getElementById('price' + id).innerText);
                            total += parseInt(input.value) * itemPrice;
                        });

                        document.getElementById('cart-subtotal').innerText = '$' + total.toFixed(2);
                        document.getElementById('cart-total').innerText = total.toFixed(2);
                    }
                })
                .catch((error) => console.error(error));
        }
    </script>

</x-layout>
