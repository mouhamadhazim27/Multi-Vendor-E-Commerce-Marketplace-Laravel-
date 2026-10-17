<div id="heroCarousel" class="carousel slide" data-bs-ride="carousel" style="z-index: -1">

    <div class="carousel-indicators">
        @for($i = 0; $i < count($slides); $i++)
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="{{ $i }}" class="{{ $i == 0 ? 'active' : '' }}"></button>    
        @endfor
    </div>

    <div class="carousel-inner">
        @foreach ($slides as $slide)
            <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                <img src="/assets/images/carousels/{{ $slide->image }}" class="d-block w-100" data-aos="flip-down" data-aos-duration="1000" data-aos-delay="500">
                <div class="carousel-caption d-none d-md-block">
                    <h2 data-aos="fade-left" data-aos-duration="1000" data-aos-delay="500" style="color: black">{{ $slide->title }}</h2>
                    <p data-aos="fade-right" data-aos-duration="1000" data-aos-delay="500" style="color: black">{{ $slide->description }}</p>
                </div>
            </div>
            
        @endforeach 
        



    </div>

    <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </button>

    <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
    </button>
</div>
