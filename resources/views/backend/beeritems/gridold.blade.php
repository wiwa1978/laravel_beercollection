
@extends('layouts.backend')

@section('content')
<div class="container">
    <div class="row">
        @foreach($beeritems as $beeritem)
            <div class="col-md-3">
                <div class="card">
                    @if(!$beeritem->getMedia('BeeritemImagesCollection')->count() == 0)
                        <a href="{{ route('beeritems.show', $beeritem->id)}}"><img class="card-img-top" src="{{ asset('storage/'. $beeritem->getMedia('BeeritemImagesCollection')[0]->id.'/'.$beeritem->getMedia('BeeritemImagesCollection')[0]->file_name)  }}" width="200" height="200" alt="{{$beeritem->name}}"></a>
                    @else
                        <a href="{{ route('beeritems.show', $beeritem->id)}}"><img class="card-img-top" src="{{ asset('storage/nopicture/nopic_200_200.png') }}" alt="{{$beeritem->item_name}}"></a>
                    @endif
                    <div class="card-body d-flex flex-column">
                        <h4>{{$beeritem->item_name}}</h4>
                        <div class="text-muted">{{$beeritem->collection->collection_name}}</div>
                        <div class="d-flex pt-5">
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
@endsection


