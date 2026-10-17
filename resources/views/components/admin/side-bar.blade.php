<nav class="col-md-3 col-lg-2 d-md-block sidebar collapse" style="background-color: #0f172a; height: 100vh;">
     <div class="position-sticky flex-column pt-3 d-flex flex-column h-100">
         <div>
             <h5 class="text-white text-center">Admin Panel<img src="/assets/image/plathaz.png" alt="Logo"
                     class="img-fluid ms-2" style="width: 30px; height: 30px;"></h5>
             <ul class="nav flex-column mt-4">
                 <li class="nav-item">
                     <a class="nav-link text-white {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">Dashboard</a>
                 </li>
                 <li class="nav-item">
                     <a class="nav-link text-white {{ request()->routeIs('admin.users') ? 'active' : '' }}" href="{{ route('admin.users') }}">Users</a>
                 </li>
                 <li class="nav-item">
                     <a class="nav-link text-white {{ request()->routeIs('admin.stores.requests') ? 'active' : '' }}" href="{{ route('admin.stores.requests') }}">Stores Requests</a>
                 </li>
                 <li class="nav-item">
                     <a class="nav-link text-white {{ request()->routeIs('admin.vendors') ? 'active' : '' }}" href="{{ route('admin.vendors') }}">Vendors</a>
                 </li>
                 <li class="nav-item">
                     <a class="nav-link text-white {{ request()->routeIs('admin.carousels') ? 'active' : '' }}" href="{{ route('admin.carousels') }}">Carousels</a>
                 </li>
                 <li class="nav-item">
                     <a class="nav-link text-white {{ request()->routeIs('admin.categories') ? 'active' : '' }}" href="{{ route('admin.categories') }}">Categories</a>
                 </li>
                   <li class="nav-item">
                     <a class="nav-link text-white {{ request()->routeIs('admin.paymentMethod') ? 'active' : '' }}" href="{{ route('admin.paymentMethod') }}">Payment method</a>
                 </li>
               
             </ul>
         </div>
         <div class="mt-auto  p-3">
             <div class="btn-group dropup">
                 <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown"
                     aria-expanded="false">
                     {{ Auth::user()->name }}
                 </button>
                 <ul class="dropdown-menu">
                     <li><a class="dropdown-item" href="#">Profile</a></li>
                     <li><a class="dropdown-item" href="#">Settings</a></li>
                     <li>
                         <hr class="dropdown-divider">
                     </li>
                     <li>
                         <form action="{{ route('logout') }}" method="POST" class="dropdown-item">
                             @csrf
                             <button type="submit" class="btn btn-link p-0">Logout</button>
                         </form>
                     </li>

                     </li>
                 </ul>
             </div>
         </div>
     </div>
 </nav>
