
@extends('layouts.backend')

@section('content')
<div class="container">

<div class="row row-cards row-deck">
            <div class="col-md-3">
        <div class="card">
            <div class="card-status bg-orange"></div>
            <div class="card-header">
                <h3 class="card-title text-center">Collections</h3>
            </div>
            <div class="card-body text-center">
               <div class="display-3 my-4"><a href="{{ route('collections.index') }}">{{ $collection_count }}</a></div>
               <div class="mt-6">collections</div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card">
            <div class="card-status bg-orange"></div>
            <div class="card-header">
                <h3 class="card-title">Breweries</h3>
            </div>
            <div class="card-body text-center">
                <div class="display-3 my-4"><a href="{{ route('breweries.index') }}">{{ $brewery_count }}</a></div>
               <div class="mt-6">breweries</div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card">
            <div class="card-status bg-orange"></div>
            <div class="card-header">
                <h3 class="card-title">Categories</h3>
            </div>
            <div class="card-body text-center">
                <div class="display-3 my-4"><a href="{{ route('categories.index') }}">{{ $category_count }}</a></div>
               <div class="mt-6">categories</div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card">
            <div class="card-status bg-orange"></div>
            <div class="card-header">
                <h3 class="card-title text-center">Beeritems</h3>
            </div>
            <div class="card-body text-center">
               <div class="display-3 my-4"><a href="{{ route('beeritems.index') }}">{{ $beeritem_count }}</a></div>
               <div class="mt-6">beeritems</div>
            </div>
        </div>
    </div>


    <div class="col-md-3">
        <div class="card">
            <div class="card-status bg-orange"></div>
            <div class="card-header">
                <h3 class="card-title">Beerglasses</h3>
            </div>
            <div class="card-body text-center">
                <div class="display-3 my-4"><a href="{{ route('beeritems.index',['item_type' => 'beerglasses']) }}">{{ $beerglasses_count }}</a></div>
               <div class="mt-6">beerglasses</div>
            </div>
        </div>
    </div>

     <div class="col-md-3">
        <div class="card">
            <div class="card-status bg-orange"></div>
            <div class="card-header">
                <h3 class="card-title">Beerashtrays</h3>
            </div>
            <div class="card-body text-center">
                <div class="display-3 my-4"><a href="{{ route('beeritems.index',['item_type' => 'beerashtrays']) }}">{{ $beerashtrays_count }}</a></div>
               <div class="mt-6">beerashtrays</div>
            </div>
        </div>
    </div>

     <div class="col-md-3">
        <div class="card">
            <div class="card-status bg-orange"></div>
            <div class="card-header">
                <h3 class="card-title">Beercontainers</h3>
            </div>
            <div class="card-body text-center">
                <div class="display-3 my-4"><a href="{{ route('beeritems.index',['item_type' => 'beercontainers']) }}">{{ $beercontainers_count }}</a></div>
               <div class="mt-6">beercontainers</div>
            </div>
        </div>
    </div>


     <div class="col-md-3">
        <div class="card">
            <div class="card-status bg-orange"></div>
            <div class="card-header">
                <h3 class="card-title">Beerlabels</h3>
            </div>
            <div class="card-body text-center">
                <div class="display-3 my-4"><a href="{{ route('beeritems.index',['item_type' => 'beerlabels']) }}">{{ $beerlabels_count }}</a></div>
               <div class="mt-6">beerlabels</div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card">
            <div class="card-status bg-orange"></div>
            <div class="card-header">
                <h3 class="card-title">Beerbottles</h3>
            </div>
            <div class="card-body text-center">
                <div class="display-3 my-4"><a href="{{ route('beeritems.index',['item_type' => 'beerbottles']) }}">{{ $beerbottles_count }}</a></div>
               <div class="mt-6">beerbottles</div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card">
            <div class="card-status bg-orange"></div>
            <div class="card-header">
                <h3 class="card-title">Beerplatteaus</h3>
            </div>
            <div class="card-body text-center">
                <div class="display-3 my-4"><a href="{{ route('beeritems.index',['item_type' => 'beerplatteaus']) }}">{{ $beerplatteaus_count }}</a></div>
               <div class="mt-6">beerplatteaus</div>
            </div>
        </div>
    </div>

   <div class="col-md-3">
        <div class="card">
            <div class="card-status bg-orange"></div>
            <div class="card-header">
                <h3 class="card-title">Beeradvertisements</h3>
            </div>
            <div class="card-body text-center">
                <div class="display-3 my-4"><a href="{{ route('beeritems.index',['item_type' => 'beeradvertisements']) }}">{{ $beeradvertisements_count }}</a></div>
               <div class="mt-6">beeradvertisements</div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card">
            <div class="card-status bg-orange"></div>
            <div class="card-header">
                <h3 class="card-title">Beercoasters</h3>
            </div>
            <div class="card-body text-center">
                <div class="display-3 my-4"><a href="{{ route('beeritems.index',['item_type' => 'beercoasters']) }}">{{ $beercoasters_count }}</a></div>
               <div class="mt-6">beercoasters</div>
            </div>
        </div>
    </div>


    <div class="col-md-3">
        <div class="card">
            <div class="card-status bg-orange"></div>
            <div class="card-header">
                <h3 class="card-title">Beerstonejugs</h3>
            </div>
            <div class="card-body text-center">
                <div class="display-3 my-4"><a href="{{ route('beeritems.index',['item_type' => 'beerstonejugs']) }}">{{ $beerstonejugs_count }}</a></div>
               <div class="mt-6">beerstonejugs</div>
            </div>
        </div>
    </div>

</div>


</div>



@endsection


