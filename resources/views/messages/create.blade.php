@extends('../immobiliers/base')
@section('content')

<form action="{{ route('save_message')  }}" method="post">
    @csrf
    <div class="form-group">
      <label for="message_titre">Object</label>
      <input type="text" class="form-control" name="message_titre" id="message_titre" aria-describedby="emailHelp" placeholder="Enter object">
    </div>
    <div class="form-group">
      <label for="message_content">Message</label>
      <input type="text" class="form-control" name="message_content" id="message_content" placeholder="Message.">
    </div>
    @auth
    @if(auth()->user()->role === 'Manager')

    <div class="form-floating">
      <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="user_id">
          <option selected disabled>Choose a user</option>
          @foreach($users as $user)
              <option value="{{ $user->id }}">{{ $user->name }} - {{$user->role}}</option>
          @endforeach
          
      </select>
      @elseif(auth()->user()->role !== 'Manager')

    <div class="form-floating">
      <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="manager_id">
          <option selected disabled>Choose a manager</option>
          @foreach($managers as $manager)
              <option value="{{ $manager->id }}">{{ $manager->name }}</option>
          @endforeach
          
      </select>
    </div>
  </div>

    @endif
    @endauth
  
 
    
    <input type="submit" class="btn btn-dark" value="Send"  />
</form>
@endsection
