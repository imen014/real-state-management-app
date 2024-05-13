@extends('../immobiliers/base')
@section('content')

<form action="{{ route('save_answer') }}" method="post">
  
  <input type="hidden" name="_token" value="{{ csrf_token() }}" />
    <div class="form-group">
      <label for="answer_titre">Object</label>
      <input type="text" class="form-control" name="answer_titre" id="answer_titre" aria-describedby="emailHelp" placeholder="Enter object">
    </div>
    <div class="form-group">
      <label for="answer_content">Message</label>
      <input type="text" class="form-control" name="answer_content" id="answer_content" placeholder="Message.">
    </div>
    <div class="form-group">
      <input type="hidden" value={{$msg_id}} class="form-control" name="msg_id" id="msg_id" placeholder="Message.">
    </div>
      
    
    <input type="submit" class="btn btn-dark" value="Send"  />
</form>
@endsection
