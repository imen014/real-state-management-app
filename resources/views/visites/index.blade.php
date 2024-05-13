@extends('immobiliers.base')
@section('content')
@include('components.my_components.navbar_deconnector')

@foreach ($visites as $visite )
<div class="card" style="width: 18rem;">
    <div class="card-body">
      <h5 class="card-title">Request number {{ $visite->id   }} </h5>
       <strong> Visite State:</strong>  <p class="card-text"> {{ $visite->visite_state   }}</p>
       <strong> Visite State:</strong><p class="card-text"> {{ $visite->user_id   }}</p>
       <strong> Real state number</strong><p class="card-text"> {{ $visite->immobilier_id   }}</p>
       <strong> Request date:</strong><p class="card-text">{{ $visite->visite_date   }}</p>
       <strong> Request time:</strong><p class="card-text">{{ $visite->visite_time   }}</p>
       <strong> Visite State:</strong><p class="card-text">{{ $visite->created_at   }}</p>

      <p class="card-text">{{ $visite->updated_at   }}</p>



      <a href="#" class="btn btn-primary">Go somewhere</a>
     
    <a href="{{ route('delete_visite',$visite->id)  }}"> <i class="bi bi-trash-fill text-danger"></i></a>  
    <a href="{{ route('show_visite',$visite->id)  }}"> <i class="bi bi-eye-fill text-primary"></i></a>  
    <a href="{{ route('edit_visite',$visite->id)  }}"> <i class="bi bi-pen-fill text-success"></i></a>   
 
 
    </div>
  </div>


@endforeach
    


@endsection


