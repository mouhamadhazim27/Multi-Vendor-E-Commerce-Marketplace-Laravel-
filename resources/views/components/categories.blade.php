<section class="py-4 bg-white">
    <div class="container">
        <div class="row text-center">
            @foreach ($categories as $category)
                {{-- Add a conditional class to hide items after the 5th --}}
                <div class="col-md-2 col-6 mb-3 category-item {{ $loop->iteration > 5 ? 'd-none' : '' }}"
                     data-aos="zoom-out">
                    <button class="btn btn-outline-dark w-100">{{ $category->category_name }}</button>
                </div>
            @endforeach

            {{-- Show "Load more" button only if there are more than 5 categories --}}
            @if($categories->count() > 5)
                <div id="load_more_container" class="col-md-2 col-6 mb-3"
                     data-aos="fade-left"
                     data-aos-anchor="#example-anchor"
                     data-aos-offset="500"
                     data-aos-duration="500">
                    <button id="load_more_btn" class="btn btn-outline-dark w-100" onclick="loadMore()">Load more</button>
                </div>
            @endif
        </div>
    </div>
</section>

<script>
    function loadMore(){
        const load_more_btn = document.getElementById('load_more_btn');
        const categoryItems = document.querySelectorAll('.category-item');
        const fifthIndex = 4;   
        const isHidden = categoryItems[fifthIndex + 1]?.classList.contains('d-none');

            if (isHidden) {
                // Show all items beyond the 5th
                for (let i = fifthIndex + 1; i < categoryItems.length; i++) {
                    categoryItems[i].classList.remove('d-none');
                }
                load_more_btn.textContent = 'Show less';
            } else {
                // Hide all items beyond the 5th
                for (let i = fifthIndex + 1; i < categoryItems.length; i++) {
                    categoryItems[i].classList.add('d-none');
                }
                load_more_btn.textContent = 'Load more';
            }      
    }
</script>