@extends('immobiliers.base')
@section('content')
@include('components.my_components.header')
@include('components.my_components.search_element')



@guest
@include('components.my_components.index_page')
 
@endguest
@auth
@include('components.my_components.index_elements')
 
@endauth



@include('components.my_components.filter')


our model
@include('components.my_components.model_dialog')
buton submit with ico
<button type="submit"><i class="text-bg-white bi bi-balloon-heart-fill text-danger"></i> </button>
<button type="submit" class="bi bi-balloon-heart-fill text-danger"></button>


@include('components.my_components.transaction_type')
@include('components.my_components.footer')




@endsection


