
@extends('layouts.backend')

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/min/dropzone.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.css">
<link rel="stylesheet" href="../css/owl.carousel.min.css">
<link rel="stylesheet" href="../css/owl.theme.default.min.css">
@endsection


@section('content')

<div class="container">
    <div class="row row-cards">
        <div class="col-12  ">
            <form method="POST" action="{{ route('beeritems.update', $beeritem->id) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="card">
                <div class="card-header">
                    <h3 class="h3 m-0 text-gray">Showing '{{ $beeritem->item_name }}'</h3>
                    <div class="card-options">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">@include('../flash-messages')</div>
            {{-- Linkerkant --}}
            <div class="col-md-6">




                <div class="card">
                    <div class="card-header text-orange"><b>Basic Information</b></div>
                    <div class="card-body">


                        <input name="item_type" type="hidden" value="{{ strtolower($type) }}">


                        <div class="form-group">
                            <label class="form-label" for="name">Name:</label>
                            <input type="text" readonly class="form-control" name="item_name" value="{{ $beeritem->item_name }}"/>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="description">Description:</label>
                            <input type="text" readonly class="form-control" name="item_description" value="{{ $beeritem->item_description }}"/>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="amount_beeritems">Amount of beeritems:</label>
                            <input id="amount_beeritems" type="text" class="form-control" readonly name="amount_beeritems" value="{{ $beeritem->item_amount }}">
                        </div>

                        <div class="form-group">
                            <div class="form-label">Add to wishlist</div>
                            <div class="custom-switches-stacked">
                                <label class="custom-switch">
                                    <input type="radio" name="wishlist" value="1" class="custom-switch-input" {{($beeritem->item_wishlist == '1') ? 'checked' : ''}}>
                                    <span class="custom-switch-indicator"></span>
                                    <span class="custom-switch-description">Yes</span>
                                </label>
                                 <label class="custom-switch">
                                    <input type="radio" name="wishlist" value="0" class="custom-switch-input" {{($beeritem->item_wishlist == '0') ? 'checked' : ''}}>
                                    <span class="custom-switch-indicator"></span>
                                    <span class="custom-switch-description">No</span>
                                </label>
                            </div>
                        </div>

                    </div>
                </div>
            </div>


            {{-- Rechterkant --}}
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-orange"><b>Classification</b></div>

                    <div class="card-body">

                        <div class="form-group">
                            <label class="form-label" for="collection_id">Collection:</label>
                            <input id="collection_id" type="text" class="form-control" readonly name="collection_id" value="{{ $collection->collection_name }}">
                        </div>



                        <div class="form-group">
                            <label class="form-label" for="brewery_id">Brewery:</label>
                            <input id="brewery_id" type="text" class="form-control" readonly name="brewery_id" value="{{ $brewery->brewery_name }}">
                        </div>



                        <div class="form-group">
                            <label class="form-label" for="category_id">Category:</label>
                            <input id="category_id" type="text" class="form-control" readonly name="category_id" value="{{ $category->category_name }}">
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="tags">Tags:</label>
                            <div>
                                @if(!$beeritem->tags->isEmpty() || !$beeritem->tags->count() == 0)
                                    @foreach($beeritem->tags as $tag)
                                        <span class="tag tag-green">{{ $tag->tag_name }}</span>
                                    @endforeach
                                @else
                                    <span class="tag tag-red">No tags </span>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
            </div>
    </div>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12"></div>
            {{-- Linkerkant --}}
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-orange"><b>Additional Information</b></div>
                    <div class="card-body">
                        @if(strtolower($type) === 'beerglasses')
                            <div class="form-group">
                                <label class="form-label" for="color">Item1 Type:</label>
                                <input readonly type="text" class="form-control" name="item_type_1" value="{{ $beeritem->item_type_1 }}"/>
                            </div>
                            @endif

                            <div class="form-group">
                                <label class="form-label" for="color">Item Text:</label>
                                <input readonly type="text" class="form-control" name="item_text" value="{{ $beeritem->item_text }}"/>
                            </div>

                            @if(strtolower($type) === 'beerashtrays' || strtolower($type) === 'beerbottles' || strtolower($type) === 'beerplateaus' || strtolower($type) === 'beercoasters' || strtolower($type) === 'beerstonejugs')
                            <div class="form-group">
                                <label class="form-label" for="color">Item Color:</label>
                                <input readonly type="text" class="form-control" name="item_color" value="{{ $beeritem->item_color }}"/>
                            </div>
                             @endif

                            @if(strtolower($type) === 'beerglasses' || strtolower($type) === 'beerashtrays' || strtolower($type) === 'beerlabels' || strtolower($type) === 'beerplateaus' || strtolower($type) === 'beeradvertisements' || strtolower($type) === 'beercoasters' || strtolower($type) === 'beerstonejugs')
                            <div class="form-group">
                                <label class="form-label" for="text_color">Text Color:</label>
                                <input readonly type="text" class="form-control" name="item_text_color" value="{{ $beeritem->item_text_color }}"/>
                            </div>
                            @endif


                            @if(strtolower($type) === 'beerglasses' || strtolower($type) === 'beerbottles' || strtolower($type) === 'beeradvertisements')
                            <div class="form-group">
                                <label class="form-label" for="type_print">Type Print:</label>
                                <input readonly type="text" class="form-control" name="item_type_print" value="{{ $beeritem->item_type_print }}"/>
                            </div>
                            @endif

                            @if(strtolower($type) === 'beerglasses' || strtolower($type) === 'beerlabels' || strtolower($type) === 'beerbottles' || strtolower($type) === 'beerplateaus' || strtolower($type) === 'beeradvertisements' || strtolower($type) === 'beercoasters'  || strtolower($type) === 'beerstonejugs')
                            <div class="form-group">
                                <label class="form-label" for="drawing">Drawing</label>
                                <input readonly type="text" class="form-control" name="item_drawing" value="{{ $beeritem->item_drawing }}"/>
                            </div>
                            @endif

                            {{--  No if statement as cluster needs to be shown for all items --}}
                            <div class="form-group">
                                <label class="form-label" for="text_color">Cluster:</label>
                                <input readonly type="text" class="form-control" name="item_cluster" value="{{ $beeritem->item_cluster }}"/>
                            </div>



                            @if(strtolower($type) === 'beerglasses' || strtolower($type) === 'beercontainers' || strtolower($type) === 'beerbottles' || strtolower($type) === 'beerplateaus' || strtolower($type) === 'beercoasters' || strtolower($type) === 'beerstonejugs')
                            <div class="form-group">
                                <label class="form-label" for="height">Height:</label>
                                <input readonly type="text" class="form-control" name="item_height" value="{{ $beeritem->item_height }}"/>
                            </div>
                            @endif

                            @if(strtolower($type) === 'beercontainers' || strtolower($type) === 'beerlabels' || strtolower($type) === 'beerplateaus' || strtolower($type) === 'beeradvertisements' || strtolower($type) === 'beercoasters')
                            <div class="form-group">
                                <label class="form-label" for="width">Width:</label>
                                <input readonly type="text" class="form-control" name="item_width" value="{{ $beeritem->item_width }}"/>
                            </div>
                            @endif

                            @if(strtolower($type) === 'beercontainers' || strtolower($type) === 'beerlabels' || strtolower($type) === 'beerplateaus' || strtolower($type) === 'beeradvertisements' || strtolower($type) === 'beercoasters')
                            <div class="form-group">
                                <label class="form-label" for="length">Length:</label>
                                <input readonly type="text" class="form-control" name="item_length" value="{{ $beeritem->item_length }}"/>
                            </div>
                            @endif

                            @if(strtolower($type) === 'beerglasses' || strtolower($type) === 'beerashtrays' || strtolower($type) === 'beerplateaus' || strtolower($type) === 'beercoasters' || strtolower($type) === 'beerstonejugs')
                            <div class="form-group">
                                <label class="form-label" for="diameter_top">Diameter top:</label>
                                <input readonly type="text" class="form-control" name="item_diameter_top" value="{{ $beeritem->item_diameter_top }}"/>
                            </div>
                            @endif

                            @if(strtolower($type) === 'beerglasses' || strtolower($type) === 'beerashtrays' || strtolower($type) === 'beerplateaus' ||  strtolower($type) === 'beercoasters' || strtolower($type) === 'beerstonejugs')
                            <div class="form-group">
                                <label class="form-label" for="diameter_bottom">Diameter bottom:</label>
                                <input readonly type="text" class="form-control" name="item_diameter_bottom" value="{{ $beeritem->item_diameter_bottom }}"/>
                            </div>
                            @endif

                    </div>
                </div>
            </div>
            {{-- Rechterkant --}}
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-orange"><b>Additional Information</b></div>
                    <div class="card-body">
                         @if(strtolower($type) === 'beerglasses' || strtolower($type) === 'beerstonejugs')
                            <div class="form-group">
                                <label class="form-label" for="weight">Weight:</label>
                                <input readonly type="text" class="form-control" name="item_weight" value="{{ $beeritem->item_weight }}"/>
                            </div>
                            @endif

                            @if(strtolower($type) === 'beerglasses' || strtolower($type) === 'beerlabels' || strtolower($type) === 'beerbottles' || strtolower($type) === 'beerstonejugs')
                            <div class="form-group">
                                <label class="form-label" for="size_indication">Size Indication:</label>
                                <input readonly type="text" class="form-control" name="item_size_indication" value="{{ $beeritem->item_size_indication }}"/>
                            </div>
                            @endif

                            @if(strtolower($type) === 'beerglasses')
                            <div class="form-group">
                                <label class="form-label" for="rib_type">Rib Type:</label>
                                <input readonly type="text" class="form-control" name="item_rib_type" value="{{ $beeritem->item_rib_type }}"/>
                            </div>
                            @endif

                            @if(strtolower($type) === 'beerglasses')
                            <div class="form-group">
                                <label class="form-label" for="facets">Facets:</label>
                                <input readonly type="text" class="form-control" name="item_facets" value="{{ $beeritem->item_facets }}"/>
                            </div>
                            @endif

                            @if(strtolower($type) === 'beerglasses' || strtolower($type) === 'beerashtrays' || strtolower($type) === 'beeradvertisements' || strtolower($type) === 'beercoasters' || strtolower($type) === 'beerstonejugs')
                            <div class="form-group">
                                <label class="form-label" for="model">Model:</label>
                                <input readonly type="text" class="form-control" name="item_model" value="{{ $beeritem->item_model }}"/>
                            </div>
                            @endif

                            @if(strtolower($type) === 'beerashtrays' || strtolower($type) === 'beerplateaus' || strtolower($type) === 'beeradvertisements' || strtolower($type) === 'beercoasters' || strtolower($type) === 'beerstonejugs')
                            <div class="form-group">
                                <label class="form-label" for="material">Material:</label>
                                <input readonly type="text" class="form-control" name="item_material" value="{{ $beeritem->item_material }}"/>
                            </div>
                            @endif

                            @if(strtolower($type) === 'beercontainers' || strtolower($type) === 'beeradvertisements')
                            <div class="form-group">
                                <label class="form-label" for="year">Year:</label>
                                <input readonly type="text" class="form-control" name="item_year" value="{{ $beeritem->item_year }}"/>
                            </div>
                            @endif

                            @if(strtolower($type) === 'beerglasses' || strtolower($type) === 'beerlabels' || strtolower($type) === 'beerbottles' || strtolower($type) === 'beerplateaus' || strtolower($type) === 'beeradvertisements' || strtolower($type) === 'beercoasters' || strtolower($type) === 'beerstonejugs')
                            <div class="form-group">
                                <label class="form-label" for="language">Language:</label>
                                <input readonly type="text" class="form-control" name="item_language" value="{{ $beeritem->item_language }}"/>
                            </div>
                            @endif

                            @if(strtolower($type) === 'beerglasses' || strtolower($type) === 'beerbottles' || strtolower($type) === 'beerstonejugs')
                            <div class="form-group">
                                <label class="form-label" for="size">Size:</label>
                                <input readonly type="text" class="form-control" name="item_size" value="{{ $beeritem->item_size }}"/>
                            </div>
                            @endif

                            @if(strtolower($type) === 'beercontainers')
                            <div class="form-group">
                                <label class="form-label" for="boxes">Boxes:</label>
                                <input readonly type="text" class="form-control" name="item_boxes" value="{{ $beeritem->item_boxes }}"/>
                            </div>
                            @endif

                            <div class="form-group">
                                <label class="form-label" for="extra_1">Extra 1:</label>
                                <input readonly type="text" class="form-control" name="item_extra_1" value="{{ $beeritem->item_extra_1 }}"/>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="extra_2">Extra 2:</label>
                                <input readonly type="text" class="form-control" name="item_extra_2" value="{{ $beeritem->item_extra_2 }}"/>
                            </div>
                    </div>
                </div>
            </div>
    </div>
    </form>
</div>


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-orange"><b>Photo Material</b></div>


                    <div class="card-body">

                            <div id="owl-demo" class="owl-carousel owl-theme">
                            @foreach($beeritemImages as $image)

                                    <div class="item">
                                        <a href="{{ asset('storage/'. $image->id.'/'.$image->file_name) }}">

                                        <img src="{{ asset('storage/'. $image->id.'/'.$image->file_name) }}" >
                                        </a>
                                    </div>


                            @endforeach
                            </div>


                    </div>
            </div>

        </div>
    </div>

</div>


@endsection

@section('scripts')


    <script>
        $(document).ready(function() {

            $("#owl-demo").owlCarousel({
                loop:true,
                autoplay:true,
                autoplayTimeout:3000,
                autoplayHoverPause:true,

                autoWidth: false,
                items : 4,
                itemsDesktop : [1199,3],
                itemsDesktopSmall : [979,3]

            });

        });
    </script>
@endsection
