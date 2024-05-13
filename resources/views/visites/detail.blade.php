@extends('../immobiliers/base')
@section('content')


  <div class="card" style="width: 18rem;">
  <div class="card-body">
    <h5 class="card-title">Request number {{ $visite->id   }} </h5>
     <strong> Visite State:</strong>  <p class="card-text"> {{ $visite->visite_state   }}</p>
     <strong> Real State Adress</strong><p class="card-text"> {{ $immobilier->state." - ".$immobilier->city   }}</p>
     <strong> Requester email</strong><p class="card-text"> {{ $user->email   }}</p>
     <strong> Request date:</strong><p class="card-text">{{ $visite->visite_date   }}</p>
     <strong> Request time:</strong><p class="card-text">{{ $visite->visite_time   }}</p>
     <strong> Request created at:</strong><p class="card-text">{{ $visite->created_at   }}</p>
     <strong> Request updated at:</strong><p class="card-text">{{ $visite->updated_at   }}</p>
    <a href="{{ route('show_immo',$immobilier->id)  }}">Real state detail</a>
    <a href="{{ route('edit_visite',$visite->id)  }}"> <i class="bi bi-pen-fill text-success"></i></a>   



    <a href="#" class="btn btn-primary">Go somewhere</a>
   
  <a href="{{ route('delete_visite',$visite->id)  }}"> <i class="bi bi-trash-fill text-danger"></i></a>  
  <a href="{{ route('show_visite',$visite->id)  }}"> <i class="bi bi-eye-fill text-primary"></i></a>   

 <i class="bi bi-pen-fill text-success"></i>
  </div>
</div>
@endsection