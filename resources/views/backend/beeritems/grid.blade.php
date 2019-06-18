
@extends('layouts.backend')

@section('content')

<div class="container">
    @include('../flash-messages')
    <div class="row row-cards">
        <div class="col-12  ">
            <form method="post" action="{{ route('beeritems.store') }}" enctype="multipart/form-data">
                    @csrf
            <div class="card">
                <div class="card-header">

                    <h3 class="h3 m-0 text-gray">Beerglasses Overview</h3>

                </div>



            </div>
            </form>
        </div>
    </div>
</div>


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12"></div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <div class="row">
        @foreach($beeritems as $beeritem)
            <div class="col-md-3">
                <div class="card">
                    @if(!$beeritem->getMedia('imagesbeerglasses')->count() == 0)
                        <a href="{{ route('beeritems.show', $beeritem->id)}}"><img class="card-img-top" src="{{ asset('storage/'. $beeritem->getMedia('images_beerglasses')[0]->id.'/'.$beeritem->getMedia('images_beerglasses')[0]->file_name)  }}" width="200" height="200" alt="{{$beeritem->name}}"></a>

                    asset('storage/'. $image->id.'/'.$image->file_name)

                        @else
                        <a href="{{ route('beeritems.show', $beeritem->id)}}"><img class="card-img-top" src="{{ asset('storage/nopicture/nopic_200_200.png') }}" alt="{{$beeritem->item_name}}"></a>
                    @endif
                    <div class="card-body d-flex flex-column">
                        <h4>{{$beeritem->item_name}}</h4>
                        <div class="text-muted">{{$beeritem->collection->collection_name}}</div>

                        <div class="d-flex pt-5 p-2">

                              <a href="{{ route('beeritems.show',$beeritem->id)}}" class="btn btn-warning btn-sm">Show</a>
                              <a href="{{ route('beeritems.edit',$beeritem->id)}}" class="btn btn-success btn-sm">Edit</a>
                              <form action="{{ route('beeritems.destroy', $beeritem->id)}}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                                                    </form>

                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection



