
@extends('layouts.backend')

@section('content')
<div class="container">
    <div class="row">
        @foreach($beeritems as $beeritem)
            <div class="col-md-3">
                <div class="card">
                    @if(!$beeritem->getMedia('BeeritemImagesCollection')->count() == 0)
                        <a href="{{ route('beeritems.show', $beeritem->id)}}"><img class="card-img-top" src="{{ asset('storage/'. $beeritem->getMedia('BeeritemImagesCollection')[0]->id.'/'.$beeritem->getMedia('BeeritemImagesCollection')[0]->file_name)  }}" alt="{{$beeritem->name}}"></a>


                        @else
                        <a href="{{ route('beeritems.show', $beeritem->id)}}"><img class="card-img-top" src="{{ asset('storage/nopicture/nopic_200_200.png') }}" alt="{{$beeritem->item_name}}"></a>

                    @endif
                    <div class="card-body d-flex flex-column">
                        <h4>{{$beeritem->item_name}}</h4>
                        <div class="text-muted">{{$beeritem->collection->collection_name}}</div>
                        <div class="d-flex align-items-center pt-5 mt-auto">
                            <div class="avatar avatar-md mr-3" style="background-image: url(./demo/faces/female/18.jpg)"></div>
                            <div>
                                <a href="./profile.html" class="text-default">{{ auth()->user()->name }}</a>
                                <small class="d-block text-muted">{{ auth()->user()->roles->pluck('name')[0] }}</small>
                            </div>
                        <div class="ml-auto text-muted">
                            <a href="#" class="icon d-none d-md-inline-block ml-3"><i class="fe fe-heart mr-1"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection


