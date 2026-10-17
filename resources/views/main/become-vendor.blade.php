<x-layout>

    <div class="container py-5">
        <h1 class="mb-4" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="500">Become a Vendor</h1>
        @if (!Auth::user()->store)
        <div class="card shadow-sm">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0">Create Store</h5>
            </div>

            <div class="card-body">
                <form action="{{ route('vendor.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row g-3">

                        <!-- Store Name -->
                        <div class="col-md-6">
                            <label class="form-label">Store Name</label>
                            <input type="text" class="form-control" name="store_name" >
                            @error('store_name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Store Slug -->
                        <div class="col-md-6">
                            <label class="form-label">Store Slug</label>
                            <input type="text" class="form-control" name="store_slug" placeholder="my-store-name"
                                >
                            <div class="form-text">Must be unique. Used in URL.</div>
                            @error('store_slug')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Business Email -->
                        <div class="col-md-6">
                            <label class="form-label">Business Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" name="business_email" value="{{ Auth::user()->email }}" readonly>
                            <div class="form-text">Must be the same email you used to log in.</div>
                            @error('business_email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            @if (session('error'))
                                <div class="container">
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                </div>
                            @endif
                        </div>

                        <!-- Phone Number -->
                        <div class="col-md-6">
                            <label class="form-label">Phone Number</label>
                            <input type="tel" class="form-control" name="phone_number" >
                            @error('phone_number')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Business Type -->
                        <div class="col-md-6">
                            <label class="form-label">Business Type</label>
                            <select class="form-select" name="business_type" >
                                <option value="">Select Type</option>
                                <option value="individual">Individual</option>
                                <option value="company">Company</option>
                            </select>
                            @error('business_type')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Store Logo -->
                        <div class="col-md-6">
                            <label class="form-label">Store Logo</label>
                            <input type="file" class="form-control" name="store_logo" accept="image/*">
                            @error('store_logo')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Address -->
                        <div class="col-12">
                            <label class="form-label">Address</label>
                            <textarea class="form-control" name="address" rows="2" ></textarea>
                            @error('address')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Store Description -->
                        <div class="col-12">
                            <label class="form-label">Store Description</label>
                            <textarea class="form-control" name="store_description" rows="4"></textarea>
                            @error('store_description')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>

                    <!-- Submit Button -->
                    <div class="mt-4 text-end">
                        <button type="submit" class="btn btn-primary">
                            Save Store
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    @else

    

 <div class="container py-5">

    @forelse(auth()->user()->unreadNotifications as $notification)
        <div class="alert alert-success" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="500">
            {{ $notification->data['message'] }}
            <a href="{{ route('vendor.dashboard') }}" class="btn btn-sm btn-success ms-3">Go to Dashboard</a>
        </div>
    @empty
        <div class="alert alert-info" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="500">
            You already have a store registered. We will review it and get back to you soon.
        </div>
    @endforelse

</div>
    @endif

   
   
</x-layout>
