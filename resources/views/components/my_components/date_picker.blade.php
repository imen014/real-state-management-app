

<div class="container">

<form style="display: none;" id="hiddenBlock" action="{{ route('store_ask_visite')   }}" method="post">
    @csrf
    <div class="form-group">
      <label for="visite_date">DateTime</label>
      <input type="date" class="form-control" name="visite_date" id="visite_date" aria-describedby="dateHelp" placeholder="Choose a date.">
      @error('visite_date')
      <div class="alert alert-info">{{ $message }}</div>
      @enderror
    </div>
    <div class="form-group">
        <label for="visite_time">Time</label>
        <input type="time" class="form-control" name="visite_time" id="visite_time" aria-describedby="emailHelp" placeholder="Enter datetime.">
        @error('visite_time')
        <div class="alert alert-info">{{ $message }}</div>
        @enderror
      </div>
      <input type="hidden" name="immobilier_id" value="{{ $immobilier->id }}">

    <input type="submit" class="btn btn-dark" value="Validate"  />
    <!-- Ajoutez ceci à votre vue -->
@if($errors->has('visite_already_requested'))
<div class="alert alert-info">{{ $errors->first('visite_already_requested') }}</div>
@endif

</form>
</div>

