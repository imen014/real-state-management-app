@extends('immobiliers.base')
@section('content')
 {{--* @include('components.my_components.navbar_deconnector')


<div class="container">
    <div class=" d-flex m-5 p-5 ">
        @include('components.my_components.accordion')
    </div>
</div>

    <div class="container">
    <div class=" m-5 p-5">
        @include('components.my_components.carousel')
    </div>
</div>

<div class="container">
    <div class=" m-5 p-5">
        @include('components.my_components.reactions')
    </div>
</div>
<form action="{{ route('add_favourite') }}" method="post">
    @csrf
    <input type="hidden" name="immobilier_id" value="{{ $immobilier->id  }}">
  <button type="submit">
    <i class="bi bi-star-half text-warning fs-3"></i></button>     
</form>
    
    <a href="{{ route('favourites') }}"><i class="bi bi-bookmark-star-fill text-warning fs-1"></i></a>
    <a href="{{ route('create_message') }}"><i class="bi bi-envelope-paper text-info fs-1"></i></a>
    <a href="{{ route('get_message') }}"><i class="bi bi-chat-fill text-info fs-1"></i></a>
{{--

    @foreach(Auth::user()->unreadNotifications as $notification)
    <div>{{ $notification->data['message'] }}</div>
@endforeach
--}}

<!-- Bouton pour afficher le bloc --> {{--
<button class="btn btn-dark" id="showButton">Plan a Visit</button>

@include('components.my_components.date_picker')
<script src="{{asset('js/show_button.js')}}" defer ></script>
--}}
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>
    /* Remove the navbar's default margin-bottom and rounded borders */ 
    .navbar {
      margin-bottom: 0;
      border-radius: 0;
    }
    
    /* Add a gray background color and some padding to the footer */
    footer {
      background-color: #f2f2f2;
      padding: 25px;
    }
    
  .carousel-inner img {
      width: 100%; /* Set width to 100% */
      margin: auto;
      min-height:200px;
  }

  /* Hide the carousel text when the screen is less than 600 pixels wide */
  @media (max-width: 600px) {
    .carousel-caption {
      display: none; 
    }
  }
  </style>
</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#">Logo</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Home</a></li>
        <li><a href="#">About</a></li>
        <li><a href="#">Projects</a></li>
        <li><a href="#">Contact</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
      </ul>
    </div>
  </div>
</nav>

@include('components.my_components.carousel')
<div class="container">
  <div class=" d-flex m-5 p-5 "> 
      @include('components.my_components.accordion')
  </div>
</div>
<div class="container text-center">    
  <h3>What We Do</h3><br>
  <div class="row">
    <div class="col-sm-4">
      <img src="https://placehold.it/150x80?text=IMAGE" class="img-responsive" style="width:100%" alt="Image">
      <p>Current Project</p>
    </div>
    <div class="col-sm-4"> 
      <img src="https://placehold.it/150x80?text=IMAGE" class="img-responsive" style="width:100%" alt="Image">
      <p>Project 2</p>    
    </div>
    <div class="col-sm-4">
      <div class="well">
       <p>Some text..</p>
      </div>
      <div class="well">
       <p>Some text..</p>
      </div>
    </div>
  </div>
</div><br>

<footer class="container-fluid text-center">
  <p>Footer Text</p>
</footer>

</body>
</html>

@endsection

