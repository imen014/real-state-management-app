@extends('../immobiliers/base')
@section('content')
<meta http-equiv="refresh" content="120"> 
@foreach ($messages as  $message)
<div class="container">
<ul class="form-group">
<div class="pt-3 pb-1 pr-2 pl-2 mt-3 mb-1 mr-2 ml-2">
   <li class="item-group bg-dark text-light"> <strong>{{ $message->message_titre  }}  </strong>

     <a href="{{ route('show_conversation',$message->id)   }}"><i class="bi bi-eye-fill text-info"></i></a>
      <a href="{{ route('delete_message',$message->id)   }}"><i class="bi bi-archive-fill text-danger"></i></a></li> 

    </div>
</ul>
@endforeach

{{--
@foreach ($notifications as $notification) 
 <strong>Notifiable type</strong>  {{  $notification->notifiable_type   }} 
 <strong>data</strong>   {{  $notification->data   }}<br>
 <strong>read at</strong>   {{  $notification->read_at   }}<br>


@endforeach

name {{  $user->name   }} - notifications {{ $notifications  }}
--}}
<a href="{{route('create_message')}}" class="btn btn-success">Start a conversation</a>
</div>

@endsection
