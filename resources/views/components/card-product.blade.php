<section class="py-5">
        <div class="container">
            <h3 class="mb-4">Featured Products</h3>

            <div class="row">

                <!-- Product -->
                @foreach ($products as $product)
                <div class="col-lg-3 col-md-6 mb-4">
                    
                    <a href="{{route('home.viewProduct' , $product->id)}}" class="card product-card" data-aos="zoom-in" >
                        <img src="/assets/images/products/{{$product->image_product}}" class="card-img-top">
                        <div class="card-body">
                            <h6 class="card-title">{{$product->product_name}}</h6>
                            <p class="text-muted small">Sold by {{$product->store->store_name}}</p>
                            <h6 class="fw-bold">${{$product->price}}</h6>
                        </div>
                    </a>
                        
                    
                </div>
                @endforeach
                
            </div>
        </div>
    </section>