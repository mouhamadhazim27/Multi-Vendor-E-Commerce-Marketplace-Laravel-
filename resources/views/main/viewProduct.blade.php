<x-layout>
    <div class="container mt-5">
        <div class="row">

            <!-- Product Image -->
            <div class="col-md-6 mb-5" data-aos="fade-right">
                <div class="card">
                    <img src="/assets/images/products/{{ $products->image_product }}" class="card-img-top img-fluid"
                        alt="{{ $products->product_name }}">
                </div>
            </div>

            <!-- Product Details -->
            <div class="col-md-6" data-aos="fade-left">
                <h2 class="mb-3">{{ $products->product_name }}</h2>

                <h4 class="text-success mb-3">
                    ${{ $products->price }}
                </h4>

                <p class="text-muted">
                    {{ $products->description }}
                </p>

                <div class="mb-3">
                    <strong>Category:</strong>
                    @foreach ($products->categories as $category)
                        {{ $category->category_name }}
                    @endforeach
                </div>

                <div class="mb-3">
                    <strong>Stock:</strong>
                </div>

                <!-- Quantity -->
                <div class="d-flex mb-3">


                    <input type="number" id="quantity" name="quantity" class="form-control w-25 me-3" value="1"
                        min="1" max="{{ $products->qunantity_in_stock }}">
                    @if (isset(session('cart')[$products->id]))
                        <button id="btn"  class="btn btn-primary disabled">Already product in cart</button>
                    @else
                        <button id="cartBTN" class="btn btn-primary btn-lg my-3" onclick="addToCart()">Add to
                            Cart</button>
                    @endif

                </div>
                {{-- @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif --}}

                @if ($products->quantity_in_stock <= 0)
                    <div class="alert alert-danger">
                        Out of stock
                    </div>
                @endif




            </div>

        </div>
    </div>

    <div class="container mt-5">
        <h3 class="mb-4">Similar Products</h3>

        <div class="row">
            @foreach ($similarProducts as $similarProduct)
                <div class="col-md-3 mb-4">
                    <div class="card h-100 shadow-sm">

                        <img src="/assets/images/products/{{ $similarProduct->image_product }}" class="card-img-top"
                            style="height:200px; object-fit:cover;">

                        <div class="card-body text-center">

                            <h6 class="card-title">
                                {{ $similarProduct->product_name }}
                            </h6>

                            <p class="text-success fw-bold">
                                ${{ $similarProduct->price }}
                            </p>

                            <a href="{{ route('home.viewProduct', $similarProduct->id) }}"
                                class="btn btn-sm btn-primary">
                                View Product
                            </a>

                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>

    <script>
        function addToCart() {
            quan = document.getElementById('quantity').value;
            const myHeaders = new Headers();
            myHeaders.append('Content-Type', "application/x-www-form-urlencoded");
            const urlencoded = new URLSearchParams();
            urlencoded.append("quantity", quan);
            urlencoded.append("_token", "{{ csrf_token() }}");
            const requestOptions = {
                method: "POST",
                headers: myHeaders,
                body: urlencoded
            };
            fetch("/cart/add/{{ $products->id }}", requestOptions)
                .then((response) => response.json())
                .then((result) => {
                    if (result.status == "success") {
                        document.getElementById('cartBTN').innerHTML = "Already in Cart";
                        document.getElementById('cartBTN').classList.add('disabled');
                    } else {
                        alert(result.message);
                    }
                })
                .catch((error) => console.error(error));
        }
    </script>
</x-layout>
