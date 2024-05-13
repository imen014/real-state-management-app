<div id="carouselExampleIndicators{{ $index }}" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        @if ($immobilier->images) <!-- Vérifiez si $immobilier->images est défini -->
            @foreach ($immobilier->images as $key => $image)
                <li data-target="#carouselExampleIndicators{{ $index }}" data-slide-to="{{ $key }}" class="{{ $key == 0 ? 'active' : '' }}"></li>
            @endforeach
        @endif
    </ol>

    <div class="carousel-inner">
        @if ($immobilier->images) <!-- Vérifiez si $immobilier->images est défini -->
            @foreach ($immobilier->images as $key => $image)
                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                    <img class="d-block w-100 img-fluid" src="{{ asset($image->path) }}" alt="Slide {{ $key }}">
                </div>
            @endforeach
        @endif
    </div>

    <a class="carousel-control-prev" href="#carouselExampleIndicators{{ $index }}" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>

    <a class="carousel-control-next" href="#carouselExampleIndicators{{ $index }}" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
