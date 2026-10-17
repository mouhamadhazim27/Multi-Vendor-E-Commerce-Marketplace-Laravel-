<x-admin.layout>
    <div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Create Carousel Slide</h4>
        </div>

        <div class="card-body">
            <form action="{{ route('carousel.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Slide Title -->
                <div class="mb-3">
                    <label class="form-label">Slide Title</label>
                    <input type="text" name="title" class="form-control" placeholder="Enter slide title" required>
                </div>

                <!-- Slide Description -->
                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="3" placeholder="Enter slide description"></textarea>
                </div>

                <!-- Slide Image -->
                <div class="mb-3">
                    <label class="form-label">Slide Image</label>
                    <input type="file" name="image" class="form-control" accept="image/*" required>
                </div>

               

                <!-- Submit -->
                <div class="text-end">
                    <button type="submit" class="btn btn-success">
                        Save Slide
                    </button>
                </div>

            </form>
        </div>
    </div>
    @foreach ($slides as $slide)
        <div class="card mt-4 shadow">
            <div class="card-body d-flex align-items-center">
                <img src="/assets/images/carousels/{{ $slide->image }}" alt="{{ $slide->title }}" class="img-thumbnail me-3" style="width: 150px; height: 100px; object-fit: cover;">
                <div>
                    <h5>{{ $slide->title }}</h5>
                    <p>{{ $slide->description }}</p>
                    <form action="{{route('carousel.delete', $slide->id)}}" method="POST" onsubmit="return confirm('Are you sure you want to delete this slide?');">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-danger">
                            Delete
                        </button>   
                    </form>
                </div>
            </div>
        </div>
        {{ $slides->links('pagination::bootstrap-5') }}
    @endforeach
</div>
</x-admin.layout>