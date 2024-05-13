<!-- Main Content -->
<div class="container">
    <h1>Liste des objets immobiliers</h1>

    @if ($immobiliers->isEmpty())
        <p>Aucun objet immobilier n'est disponible pour le moment.</p>
    @else
    <div class="container">
        <table class="table" id="myTable">
            <thead class="thead-dark">
              <tr>
                <th scope="col">#</th>
                <th scope="col"><strong>Type</strong> </th>
                <th scope="col"><strong>Owner</strong></th>
                <th scope="col"> <strong>City</strong></th>
                <th scope="col"><strong>State</strong></th>
                <th scope="col"><strong>Transaction type</strong></th>
                <th scope="col"><strong>Price </strong>($)</th>
                <th scope="col"><strong>Pieces number</strong></th>
                <th scope="col"><strong>Likes</strong></th>
               


                <div class="container">
               <!-- <th scope="col"><strong> Actions <a href="{{ route('create_immo')  }}"><i class="bi bi-plus text-info fs-1"></i></a> </strong></th>
               -->
              
           <th scope="col"><strong>Address</strong></th>
            
            <th scope="col"><strong>Description</strong></th>
            
            
            <th scope="col"><strong>Action</strong></th>
              </tr>
            </thead>
            <tbody>
                @foreach ($immobiliers as $immobilier)
                  
              <tr>
                <th scope="row">{{ $immobilier->id }}</th>
                <td> {{ $immobilier->type }}</td>
                <td> {{ $immobilier->owner->name }}</td>
                <td>{{ $immobilier->city }}</td>
                <td>{{ $immobilier->state }}</td>
                <td>{{ $immobilier->transaction_type }}</td>
                <td>{{ $immobilier->price }}.000</td>
                <td>{{  $immobilier->piece_number }}</td>
                <td> <p> <i class="bi bi-hand-thumbs-up-fill text-primary fs-3 fw-semibold icon-link-hover "></i>{{ $num_likes[$immobilier->id] }}</p>
                  <p>  <i class="bi bi-hand-thumbs-down-fill text-primary fs-3 fw-semibold icon-link-hover "></i> {{ $num_dislikes[$immobilier->id] }}</p>
                  <p> <i class="bi bi-balloon-heart-fill text-danger fs-3 fw-semibold icon-link-hover "></i>{{ $num_hearts[$immobilier->id] }}</p></td>
                  <td>{{  $immobilier->address }}</td>
                  <td>{{  $immobilier->description }}</td>

                <td>
                @if(Auth::check() && $immobilier->owner_id === Auth::user()->id)
                <a class="icon-link icon-link-hover link-success link-underline-success link-underline-opacity-25" href="{{ route('edit_immo', $immobilier->id)  }}"><i class="fs-3  fw-semibold bi bi-pencil-square text-success"></i></i></a>
              @endif
              
              @if(Auth::check() && $immobilier->owner_id === Auth::user()->id)
                  <a class="icon-link icon-link-hover link-success link-underline-success link-underline-opacity-25" href="{{ route('destroy_immo', $immobilier->id)  }}"><i class="fs-3  fw-semibold bi bi-archive-fill text-danger"></i></a>
              @endif

           
                  <a class="icon-link icon-link-hover link-success link-underline-success link-underline-opacity-25" href="{{ route('show_immo', $immobilier->id)  }}"><i class="fs-3  fw-semibold bi bi-eye-fill text-primary"></i></a>

              </td>
              </tr>
              @endforeach
           
            </tbody>
          </table>
          
        
    @endif
</div>
      
</div>
