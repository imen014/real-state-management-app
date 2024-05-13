<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    @foreach($images as $key => $image)
    <li data-target="#carouselExampleIndicators" data-slide-to="{{ $key }}" @if($loop->first) class="active" @endif></li>
    @endforeach
  </ol>
  <div class="carousel-inner">
    @foreach($images as $key => $image)
    <div class="carousel-item @if($loop->first) active @endif">
      <img class="d-block w-100 img-fluid" style="max-height: 400px;" src="{{ asset($image->image_path) }}" alt="Slide {{ $key + 1 }}">
    </div>
    @endforeach
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
