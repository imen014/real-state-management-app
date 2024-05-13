@extends('../immobiliers/base')
@section('content')

@foreach ($messages as $message)

{{$message->message_titre}}
    
@endforeach

<a href="{{route('create_message')}}" class="btn btn-success">Start a conversation</a>



@endsection