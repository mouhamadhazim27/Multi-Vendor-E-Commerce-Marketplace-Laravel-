 <div class="col-lg-2 col-md-3 bg-white sidebar collapse d-lg-block" id="sidebar">
            <ul class="nav flex-column p-3">

                <li class="nav-item mb-2">
                    {{-- use named route and highlight when on dashboard --}}
                    <a class="nav-link {{ request()->routeIs('vendor.dashboard') ? 'active text-primary fw-bold' : 'text-dark' }}"
                       href="{{ route('vendor.dashboard') }}">
                        Dashboard
                    </a>
                </li>

                <li class="nav-item mb-2">
                    <a class="nav-link text-dark {{ request()->routeIs('vendor.mystore') ? 'active text-primary fw-bold' : 'text-dark' }}" href="{{route('vendor.mystore')}}">My Store</a>
                </li>

                <li class="nav-item mb-2">
                    <a class="nav-link text-dark {{ request()->routeIs('vendor.products') ? 'active text-primary fw-bold' : 'text-dark' }}" href="{{ route('vendor.products') }}">Products</a>
                </li>

                <li class="nav-item mb-2">
                    <a class="nav-link text-dark {{ request()->routeIs('vendor.orders') ? 'active text-primary fw-bold' : 'text-dark' }}" href="{{ route('vendor.orders') }}">Orders</a>
                </li>

                <li class="nav-item">
                    
                        <form method="POST" action="{{ route('logout') }}" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-link p-0 m-0 align-baseline text-danger">Logout</button>
                        </form>
                    
                </li>

            </ul>
</div>