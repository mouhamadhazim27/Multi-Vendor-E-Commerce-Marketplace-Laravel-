<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
    <div class="container-fluid" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="500">
        <button class="btn btn-light d-lg-none" data-bs-toggle="collapse" data-bs-target="#sidebar">
            ☰
        </button>
        <img src="/assets/images/stores/{{ Auth::user()->store->store_logo ?? 'default-logo.png' }}" 
             alt="Store Logo" 
             width="45" 
             height="45" 
             class="me-2 rounded-circle" style="border: 1px solid black">
        <span class="navbar-brand ms-2">{{Auth::user()->store->store_name ?? 'Vendor'}} Dashboard</span>

        <div class="ms-auto text-white" >
            Welcome, {{ Auth::user()->name ?? 'Vendor' }}
        </div>
    </div>
</nav>