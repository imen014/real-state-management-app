@extends('../immobiliers/base')
@section('content')

<div class="container">

    <form method="post" action="{{ route('update_visite',$visite->id)   }}">
        @csrf
        @method('PUT')
        <div class="form-group">
          <label for="visite_date">DateTime</label>
          <input value="{{ old('visite_date')  }}" type="date" class="form-control" name="visite_date" id="visite_date" aria-describedby="dateHelp" placeholder="Choose a date.">
          @error('visite_date')
          <div class="alert alert-info">{{ $message }}</div>
          @enderror
        </div>
        <div class="form-group">
            <label for="visite_time">Time</label>
            <input value="{{ old('visite_time')  }}" type="time" class="form-control" name="visite_time" id="visite_time" aria-describedby="emailHelp" placeholder="Enter datetime.">
            @error('visite_time')
            <div class="alert alert-info">{{ $message }}</div>
            @enderror
          </div>
          <input type="hidden" name="immobilier_id" value="{{ $immobilier->id }}">
    
        <input type="submit" class="btn btn-dark" value="Validate"  />
        <!-- Ajoutez ceci à votre vue -->
   
    
    </form>
    </div>
    
@endsection