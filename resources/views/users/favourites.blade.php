@extends('../immobiliers.base')
@section('content')

@include('components.my_components.navbar_deconnector')


    <div class="container">
        <table class="table table-dark">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Transaction type</th>
                    <th scope="col">Type</th>
                    <th scope="col">Number of pieces</th>
                    <th scope="col">Price</th>
                    <th scope="col">City</th>
                    <th scope="col">State</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($immobiliers as $immobilier)
                <tr>
                    <th scope="row">1</th>
                        <td>{{  $immobilier->transaction_type }}</td>
                        <td>{{ $immobilier->type }}</td>      
                        <td>{{ $immobilier->piece_number }}</td>
                        <td>{{ $immobilier->price }}</td>
                        <td>{{ $immobilier->city }}</td>
                        <td>{{ $immobilier->state }}</td>
                        <td><a class="icon-link icon-link-hover link-success link-underline-success link-underline-opacity-25" href="{{ route('show_immo', $immobilier->id)  }}"> <i class="bi bi-arrow-right-circle text-light "></i></a>
                        <a class="icon-link icon-link-hover link-success link-underline-success link-underline-opacity-25" href="{{ route('destroy_immo', $immobilier->id)  }}"> <i class="bi bi-dash-circle text-light"></i></a>

                           
                            <i class="bi bi-calendar-heart text-light "></i>
                        </td>

                        <td colspan="7">Immobilier not found</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection
