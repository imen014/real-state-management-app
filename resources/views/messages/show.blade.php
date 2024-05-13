@extends('../immobiliers/base')

@section('content')

<div class="row">
    <div class="col-5">
        <div class="m-5 p-5">
            <div class="container">
                <div class="card" style="width: 18rem;">
                    <i class="bi bi-gear-fill"></i>
                    <div class="card-body">
                        @foreach ($messages as $message)
                            <h5 class="card-title">{{ $message->message_titre }}</h5>
                            <p class="card-text">{{ $message->message_content }} .</p>
                            <a href="{{route('delete_conversation',$message->id)}}" class="btn btn-danger">Delete</a>

                            @if($message->answers->isNotEmpty())
                                <h6>Réponses :</h6>
                                <ul>
                                    @foreach($message->answers as $answer)
                                        <li>
                                            <h5 class="card-title">{{  $answer->answer_titre }}</h5>
                                            <p class="card-text">{{ $answer->answer_content }} .</p>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        @endforeach
                    </div>
                </div>

                <form action="{{route('create_answer')}}" method="get">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    <input type="hidden" name="msg_id" id="msg_id" value="{{ $message->id}}" />
                    <input value="Answer" type="submit" class="btn btn-primary" />
                </form>
            </div>
        </div>
    </div>
    <div class="col-5">
        <div class="m-5 p-5">
            <div class="container">
                <ul class="list-group">
                    <li class="list-group-item">{{$conversation->user1_id}}</li>
                    @foreach ($messages as $message)
                        <li class="list-group-item">{{$message->message_titre}}</li>
                    @endforeach
                    <li class="list-group-item">A second item</li>
                    <li class="list-group-item">A third item</li>
                    <li class="list-group-item">A fourth item</li>
                    <li class="list-group-item">And a fifth one</li>
                </ul>
            </div>
        </div>
    </div>
</div>

@endsection
