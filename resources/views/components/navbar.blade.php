 <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
     <div class="container">
         <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}" data-aos="flip-down"
             data-aos-duration="1000" data-aos-delay="500">
             <img src="/assets/image/plathaz.png" alt="Logo" height="40" class="me-2">
             <span class="fw-bold text-white">HazimPlat</span>
         </a>

         <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
             <span class="navbar-toggler-icon"></span>
         </button>

         <div class="collapse navbar-collapse" id="navbarContent" data-aos="flip-down" data-aos-duration="1000"
             data-aos-delay="500">
             <div class="position-relative mx-auto w-50">

                 <form class="d-flex">
                     <input class="form-control me-2" id="search" type="search" placeholder="Search products, vendors...">
                 </form>

                  <div class="list-group position-absolute w-100 mt-1 shadow " id="results"></div> 
             </div>

             <ul class="navbar-nav ms-auto" data-aos="flip-down" data-aos-duration="1000" data-aos-delay="500">
                 @auth
                     <li class="nav-item"><a class="nav-link {{ request()->routeIs('vendor.register') ? 'active' : '' }}"
                             href="{{ route('vendor.register') }}">Become a Vendor
                             ({{ auth()->user()->unreadNotifications->count() }})</a></li>
                     @if (Auth::user()->role === 'vendor')
                         <li class="nav-item"><a
                                 class="nav-link {{ request()->routeIs('vendor.dashboard') ? 'active' : '' }}"
                                 href="{{ route('vendor.dashboard') }}">Dashboard Vendor</a></li>
                     @endif
                     <li class="nav-item">
                         <form action="{{ route('logout') }}" method="POST">
                             @csrf
                             <input type="submit" class="nav-link" value="Logout">
                         </form>
                     </li>
                 @endauth
                 @guest
                     <li class="nav-item"><a class="nav-link   {{ request()->routeIs('login.page') ? 'active' : '' }}" href="{{ route('login.page') }}">Login</a></li>
                 @endguest
                 <li class="nav-item"><a class="nav-link  {{ request()->routeIs('cart') ? 'active' : '' }}" href="{{route('cart')}}">Cart (0)</a></li>
             </ul>
         </div>
     </div>
 </nav>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
let debounceTimer;

$('#search').on('keyup', function () {

    let value = $(this).val();

    // ✅ Clear previous timer (debounce)
    clearTimeout(debounceTimer);

    // ✅ If empty → clear results
    if (value.length === 0) {
        $('#results').html('').hide();
        return;
    }

    // ✅ Debounce (wait 300ms before request)
    debounceTimer = setTimeout(() => {

        $.ajax({
            type: 'GET',
            url: "{{ url('search') }}",
            data: { search: value },

            // 🔄 Loading state
            beforeSend: function () {
                $('#results')
                    .html('<div class="list-group-item">🔍 Searching...</div>')
                    .show();
            },

            success: function (data) {

                if (data.trim() === '') {
                    $('#results').html('<div class="list-group-item">No results found</div>');
                } else {
                    $('#results').html(data);
                }
            },

            error: function () {
                $('#results').html('<div class="list-group-item text-danger">Error loading results</div>');
            }
        });

    }, 300); // delay

});


// ✅ Hide results when clicking outside
$(document).click(function (e) {
    if (!$(e.target).closest('#search, #results').length) {
        $('#results').hide();
    }
});

// ✅ Show again when focusing input
$('#search').on('focus', function () {
    if ($(this).val().length > 0) {
        $('#results').show();
    }
});
</script>