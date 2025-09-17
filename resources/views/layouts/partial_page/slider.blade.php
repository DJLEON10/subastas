@php
    $activeIndex = 0;  // Variable para almacenar el índice activo del carrusel
@endphp
<!-- Carousel Start -->
 
 <div class="carousel-header">
    <div id="carouselId" class="carousel slide" data-bs-ride="carousel">
        <ol class="carousel-indicators">
            @foreach ($sliders as $index => $slider)
                    <li data-bs-target="#carouselId" data-bs-slide-to="{{$activeIndex}}"
                        class="{{$activeIndex == 0 ? 'active' : ''}}"></li>
                    @php  $activeIndex++ @endphp
         
            @endforeach

        </ol>
        <div class="carousel-inner" role="listbox">
            @php
            $activeIndex = 0 ;
            @endphp

            @foreach($sliders as $slider )
            <div class="carousel-item {{ $activeIndex == 0 ? 'active' : '' }}">
                <img src="{{ asset('uploads/slider/' . $slider->imagen) }}" class="img-fluid" alt="Image">
                <div class="carousel-caption">
                    <div class="p-3" style="max-width: 900px;">
                        <h1 class="display-2 text-capitalize text-white mb-4">{{ $slider->titulo }}</h1>
                        <p class="mb-5 fs-5">{{ $slider->descripcion }}</p>

                        <div class="d-flex align-items-center justify-content-center">
                            <a class="btn-hover-bg btn btn-primary rounded-pill text-white py-3 px-5" target="_blank" href="{{  $slider->link_boton }}">{{ $slider->nombre_boton }}</a>
                        </div>
                    </div>
                </div>
            </div>

            @php $activeIndex++ ; @endphp
            @endforeach

        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselId" data-bs-slide="prev">
            <span class="carousel-control-prev-icon btn bg-primary" aria-hidden="false"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselId" data-bs-slide="next">
            <span class="carousel-control-next-icon btn bg-primary" aria-hidden="false"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>