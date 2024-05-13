@extends('../immobiliers.base')
@section('content')

<div class="row">
  <div class="col-8">

  
<div class="p-3 bg-white bg-opacity-10 border  border-start-0 rounded-end container">
<div class="container">
<form  action="{{ route('save_immo')  }}" method="post"  enctype="multipart/form-data">

  <input type="hidden" name="_token" value="{{ csrf_token() }}" />
<!--
<div class="p-3 bg-white bg-opacity-10 border  border-start-0 rounded-end mb-3">
<span class="bg-primary p-3  badge">Owner</span>
  <input type="text" class="p-3 bg-white bg-opacity-10 border  border-start-0 rounded-end form-control" name="owner" id="owner" placeholder="Owner.">
</div> -->
<!--type select:maison appartement-->
<div class="p-3 bg-white bg-opacity-10 border  border-start-0 rounded-end mb-3">
<select name="type" id="type" class="p-3 bg-white bg-opacity-10 border  border-start-0 rounded-end form-select" aria-label="Typical real estate">
  <option selected>Typical real estate</option>
  <option value="House" {{ old('type') == 'House' ? 'selected' : '' }}>House</option>
  <option value="Apartment" {{ old('type') == 'Apartment' ? 'selected' : '' }}>Apartment</option>
  <option value="Studio"  {{ old('type') == 'Studio' ? 'selected' : '' }}>Studio</option>
  <option value="Villa"  {{ old('type') == 'Villa' ? 'selected' : '' }}>Villa</option>
</select>
@error('type')
<div class="alert alert-danger">{{ $message }}</div>
@enderror
</div>

<div class="p-3 bg-white bg-opacity-10 border  border-start-0 rounded-end mb-3">
  <span class="bg-primary p-3  badge">City</span>
    <input value="{{ old('city') }}" type="text" class="p-3 bg-white bg-opacity-10 border  border-start-0 rounded-end form-control" name="city" id="city" placeholder="City.">
    @error('city')
<div class="alert alert-danger">{{ $message }}</div>
@enderror
  </div>

  <div class="p-3 bg-white bg-opacity-10 border  border-start-0 rounded-end mb-3">
    <span class="bg-primary p-3  badge">State</span>
      <input value="{{ old('state') }}"  type="text" class="p-3 bg-white bg-opacity-10 border  border-start-0 rounded-end form-control" name="state" id="state" placeholder="State.">
      @error('state')
        <div class="text-danger">{{ $message }}</div>
      @enderror
  </div>
      
    

<div class="p-3 bg-white bg-opacity-10 border  border-start-0 rounded-end mb-3">
<span class="bg-primary p-3  badge">Price</span>
  <input value="{{ old('price') }}" type="number" class="p-3 bg-white bg-opacity-10 border  border-start-0 rounded-end form-control" name="price" id="price" placeholder="price">
  @error('price')
  <div class="alert alert-danger">{{ $message }}</div>
  @enderror
</div>
<div class="p-3 bg-white bg-opacity-10 border  border-start-0 rounded-end mb-3">
<span class="bg-primary p-3  badge">Pieces Number</span>
  <input value="{{ old('piece_number') }}" type="number" class="p-3 bg-white bg-opacity-10 border  border-start-0 rounded-end form-control" name="piece_number" id="piece_number" placeholder="pieces_number">
  @error('piece_number')
  <div class="alert alert-danger">{{ $message }}</div>
  @enderror
</div>

<div class="p-3 bg-white bg-opacity-10 border  border-start-0 rounded-end mb-3">
  <span  class="bg-primary p-3  badge">Address</span>
    <input autocomplete='address' value="{{ old('address') }}" type="text" class="p-3 bg-white bg-opacity-10 border  border-start-0 rounded-end form-control" name="address" id="address" placeholder="Address.">
    @error('address')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
  </div>
  <div class="p-3 bg-white bg-opacity-10 border  border-start-0 rounded-end mb-3">
    <span class="bg-primary p-3  badge">Latitude</span>
      <input value="{{ old('latitude') }}" type="number" class="p-3 bg-white bg-opacity-10 border  border-start-0 rounded-end form-control" name="latitude" id="latitude" placeholder="Latitude.">
      @error('latitude')
      <div class="alert alert-danger">{{ $message }}</div>
      @enderror
    </div>
    <div class="p-3 bg-white bg-opacity-10 border  border-start-0 rounded-end mb-3">
      <span class="bg-primary p-3  badge">Longitude</span>
        <input  value="{{ old('longitude') }}"  type="number" class="p-3 bg-white bg-opacity-10 border  border-start-0 rounded-end form-control" name="longitude" id="longitude" placeholder="Longitude.">
        @error('longitude')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
      </div>
      <div class="p-3 bg-white bg-opacity-10 border  border-start-0 rounded-end mb-3">
        <span class="bg-primary p-3  badge">Living area </span>
          <input value="{{ old('surface_habitable') }}"  type="number" class="p-3 bg-white bg-opacity-10 border  border-start-0 rounded-end form-control" name="surface_habitable" id="surface_habitable" placeholder="Surface habitable.">
          @error('surface_habitable')
          <div class="alert alert-danger">{{ $message }}</div>
          @enderror
        </div>
        <div class="p-3 bg-white bg-opacity-10 border  border-start-0 rounded-end mb-3">
          <span class="bg-primary p-3  badge">  Land area </span>
            <input value="{{ old('surface_terrain') }}" type="number" class="p-3 bg-white bg-opacity-10 border  border-start-0 rounded-end form-control" name="surface_terrain" id="surface_terrain" placeholder="Surface terrain">
            @error('surface_terrain')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
          </div>
          <div class="p-3 bg-white bg-opacity-10 border  border-start-0 rounded-end mb-3">
            <span class="bg-primary p-3  badge"> Year of construction  </span>
              <input value="{{ old('annee_construction') }}" type="number" class="p-3 bg-white bg-opacity-10 border  border-start-0 rounded-end form-control" name="annee_construction" id="annee_construction" placeholder="Year of construction">
              @error('annee_construction')
              <div class="alert alert-danger">{{ $message }}</div>
              @enderror
            </div>
            <div class="p-3 bg-white bg-opacity-10 border  border-start-0 rounded-end mb-3">
              <span class="bg-primary p-3  badge">Description</span>
                <textarea value="{{ old('description') }}"  maxlength="255" class="p-3 bg-white bg-opacity-10 border  border-start-0 rounded-end form-control" name="description" id="description" rows="3" placeholder="Max length 255 caracter."></textarea>
                @error('description')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="1" name="has_pool" id="has_pool" {{ old('has_pool') ? 'checked' : '' }}>
                <label class="form-check-label" for="has_pool">
                  Has pool                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="1" name="has_garden" id="has_garden" {{ old('has_garden') ? 'checked' : '' }} >
                <label class="form-check-label" for="has_garden">
                  Has garden
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="1" name="has_garage" id="has_garage" {{ old('has_garage') ? 'checked' : '' }}>
                <label class="form-check-label" for="has_garage">
                  Has garage
                </label>
              </div>
           


<!--type select:maison appartement-->
<div class="p-3 bg-white bg-opacity-10 border  border-start-0 rounded-end mb-3">
<select name="transaction_type" id="transaction_type" class="p-3 bg-white bg-opacity-10 border  border-start-0 rounded-end form-select" aria-label="Typical real estate">
  <option selected>Tranaction type</option>
  <option value="Sale" {{ old('type') == 'Sale' ? 'selected' : '' }}>Sale</option>
  <option value="Rental" {{ old('type') == 'Rental' ? 'selected' : '' }}>Rental</option>

</select>
@error('transaction_type')
  <div class="alert alert-danger">{{ $message }}</div>
  @enderror
</div>


<div class="p-3 bg-white bg-opacity-10 border  border-start-0 rounded-end mb-3">
<span class="bg-primary p-3  badge">Real estate image</span> 
 <input class="p-3 bg-white bg-opacity-10 border  border-start-0 rounded-end form-control" type="file" required name="real_estate_image_req[]" id="real_estate_image_req" multiple>
 @error('real_estate_image_req')
  <div class="alert alert-danger">{{ $message }}</div>
  @enderror
</div>

<input type="submit" class="p-3 bg-opacity-10 border  border-start-0 rounded-end btn btn-primary" value="Validate">
</form>
</div>
</div>
</div>



</div>
</div>
@endsection