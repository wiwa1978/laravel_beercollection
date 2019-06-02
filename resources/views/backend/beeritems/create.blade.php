
@extends('layouts.backend')

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/min/dropzone.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.css">

@endsection


@section('content')

<div class="container">
    <div class="row row-cards">
        <div class="col-12  ">
            <form method="post" action="{{ route('beeritems.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="card">
                <div class="card-header">
                    <h3 class="h3 m-0 text-gray">Adding {{ $type }}</h3>
                    <div class="card-options">
                        <button type="submit" id="button" class="btn btn-success">Save changes</button>
                        <a href="{{ route('beeritems.create') }}" class="btn btn-danger btn-close ml-2">Cancel</a>
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
                        <fieldset class="form-fieldset">

                        @if ($type == 'Beeritem')
                            <div class="form-group">
                                <label class="form-label" for="name">Item Type:</label>
                                <select class="form-control" name="item_type" >
                                    @foreach($collection_types as $collection_type)
                                        <option value="{{ $collection_type }}">{{ ucfirst($collection_type) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @else

                        @endif

                        <div class="form-group">
                            <label class="form-label" for="name">Name: (*)</label>
                            <input type="text" class="form-control" name="item_name" value="{{ old('item_name') }}" />
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="description">Description:</label>
                            <input type="text" class="form-control" name="item_description" value="{{ old('item_description') }}"/>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="amount_beeritems">Amount of {{ str_plural(strtolower($type)) }}: (*)</label>
                            <select class="form-control" name="amount_beeritems">
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                                <option value="4">Four</option>
                                <option value="5">Five</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <div class="form-label">Add to wishlist (*)</div>
                            <div class="custom-switches-stacked">
                                <label class="custom-switch">
                                    <input type="radio" name="wishlist" value="1" class="custom-switch-input">
                                    <span class="custom-switch-indicator"></span>
                                    <span class="custom-switch-description">Yes</span>
                                </label>
                                 <label class="custom-switch">
                                    <input type="radio" name="wishlist" value="0" class="custom-switch-input" checked>
                                    <span class="custom-switch-indicator"></span>
                                    <span class="custom-switch-description">No</span>
                                </label>
                            </div>
                        </div>
                        </fieldset>
                    </div>
                </div>
            </div>


            {{-- Rechterkant --}}
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-orange"><b>Classification</b></div>

                    <div class="card-body">

                        <fieldset class="form-fieldset">
                        <div class="form-group">
                        <label class="form-label" for="collection">Collection: (*)</label>
                            <select class="form-control m-bot15" name="collection_id">
                                @foreach($collections as $collection)
                                    <option value="{{ $collection->id }}">{{$collection->collection_name}}</option>
                                @endForeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="brewery">Brewery: (*)</label>
                            <select class="form-control" name="brewery_id" >
                                @foreach($breweries as $brewery)
                                    <option value="{{ $brewery->id }}">{{ $brewery->brewery_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="tags">Category: (*)</label>
                            <select class="form-control" name="category_id" >
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="tags">Tags:  (*)</label>
                            <select class="form-control js-example-basic-multiple" name="beeritem_tags[]" multiple="multiple">
                                @foreach($tags as $tag)
                                    <option value="{{$tag->id}}">{{$tag->tag_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        </fieldset>
                         (*) mandatory fields

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
                        <fieldset class="form-fieldset">
                        @if(strtolower($type) === 'beerglasses')
                            <div class="form-group">
                                <label class="form-label" for="color">Item1 Type:</label>
                                <input type="text" class="form-control" name="item_type_1"/>
                            </div>
                            @endif

                            <div class="form-group">
                                <label class="form-label" for="color">Item Text:</label>
                                <input type="text" class="form-control" name="item_text"/>
                            </div>

                            @if(strtolower($type) === 'beerashtrays' || strtolower($type) === 'beerbottles' || strtolower($type) === 'beerplateaus' || strtolower($type) === 'beercoasters' || strtolower($type) === 'beerstonejugs')
                            <div class="form-group">
                                <label class="form-label" for="color">Item Color:</label>
                                <input type="text" class="form-control" name="item_color"/>
                            </div>
                             @endif

                            @if(strtolower($type) === 'beerglasses' || strtolower($type) === 'beerashtrays' || strtolower($type) === 'beerlabels' || strtolower($type) === 'beerplateaus' || strtolower($type) === 'beeradvertisements' || strtolower($type) === 'beercoasters' || strtolower($type) === 'beerstonejugs')
                            <div class="form-group">
                                <label class="form-label" for="text_color">Text Color:</label>
                                <input type="text" class="form-control" name="item_text_color"/>
                            </div>
                            @endif


                            @if(strtolower($type) === 'beerglasses' || strtolower($type) === 'beerbottles' || strtolower($type) === 'beeradvertisements')
                            <div class="form-group">
                                <label class="form-label" for="type_print">Type Print:</label>
                                <input type="text" class="form-control" name="item_type_print"/>
                            </div>
                            @endif

                            @if(strtolower($type) === 'beerglasses' || strtolower($type) === 'beerlabels' || strtolower($type) === 'beerbottles' || strtolower($type) === 'beerplateaus' || strtolower($type) === 'beeradvertisements' || strtolower($type) === 'beercoasters'  || strtolower($type) === 'beerstonejugs')
                            <div class="form-group">
                                <label class="form-label" for="drawing">Drawing</label>
                                <input type="text" class="form-control" name="item_drawing"/>
                            </div>
                            @endif

                            {{--  No if statement as cluster needs to be shown for all items --}}
                            <div class="form-group">
                                <label class="form-label" for="text_color">Cluster:</label>
                                <input type="text" class="form-control" name="item_cluster"/>
                            </div>



                            @if(strtolower($type) === 'beerglasses' || strtolower($type) === 'beercontainers' || strtolower($type) === 'beerbottles' || strtolower($type) === 'beerplateaus' || strtolower($type) === 'beercoasters' || strtolower($type) === 'beerstonejugs')
                            <div class="form-group">
                                <label class="form-label" for="height">Height:</label>
                                <input type="text" class="form-control" name="item_height"/>
                            </div>
                            @endif

                            @if(strtolower($type) === 'beercontainers' || strtolower($type) === 'beerlabels' || strtolower($type) === 'beerplateaus' || strtolower($type) === 'beeradvertisements' || strtolower($type) === 'beercoasters')
                            <div class="form-group">
                                <label class="form-label" for="width">Width:</label>
                                <input type="text" class="form-control" name="item_width"/>
                            </div>
                            @endif

                            @if(strtolower($type) === 'beercontainers' || strtolower($type) === 'beerlabels' || strtolower($type) === 'beerplateaus' || strtolower($type) === 'beeradvertisements' || strtolower($type) === 'beercoasters')
                            <div class="form-group">
                                <label class="form-label" for="length">Length:</label>
                                <input type="text" class="form-control" name="item_length"/>
                            </div>
                            @endif

                            @if(strtolower($type) === 'beerglasses' || strtolower($type) === 'beerashtrays' || strtolower($type) === 'beerplateaus' || strtolower($type) === 'beercoasters' || strtolower($type) === 'beerstonejugs')
                            <div class="form-group">
                                <label class="form-label" for="diameter_top">Diameter top:</label>
                                <input type="text" class="form-control" name="item_diameter_top"/>
                            </div>
                            @endif

                            @if(strtolower($type) === 'beerglasses' || strtolower($type) === 'beerashtrays' || strtolower($type) === 'beerplateaus' ||  strtolower($type) === 'beercoasters' || strtolower($type) === 'beerstonejugs')
                            <div class="form-group">
                                <label class="form-label" for="diameter_bottom">Diameter bottom:</label>
                                <input type="text" class="form-control" name="item_diameter_bottom"/>
                            </div>
                            @endif
                        </fieldset>

                    </div>
                </div>
            </div>
            {{-- Rechterkant --}}
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-orange"><b>Additional Information</b></div>
                    <div class="card-body">
                        <fieldset class="form-fieldset">
                         @if(strtolower($type) === 'beerglasses' || strtolower($type) === 'beerstonejugs')
                            <div class="form-group">
                                <label class="form-label" for="weight">Weight:</label>
                                <input type="text" class="form-control" name="item_weight"/>
                            </div>
                            @endif

                            @if(strtolower($type) === 'beerglasses' || strtolower($type) === 'beerlabels' || strtolower($type) === 'beerbottles' || strtolower($type) === 'beerstonejugs')
                            <div class="form-group">
                                <label class="form-label" for="size_indication">Size Indication:</label>
                                <input type="text" class="form-control" name="item_size_indication"/>
                            </div>
                            @endif

                            @if(strtolower($type) === 'beerglasses')
                            <div class="form-group">
                                <label class="form-label" for="rib_type">Rib Type:</label>
                                <input type="text" class="form-control" name="item_rib_type"/>
                            </div>
                            @endif

                            @if(strtolower($type) === 'beerglasses')
                            <div class="form-group">
                                <label class="form-label" for="facets">Facets:</label>
                                <input type="text" class="form-control" name="item_facets"/>
                            </div>
                            @endif

                            @if(strtolower($type) === 'beerglasses' || strtolower($type) === 'beerashtrays' || strtolower($type) === 'beeradvertisements' || strtolower($type) === 'beercoasters' || strtolower($type) === 'beerstonejugs')
                            <div class="form-group">
                                <label class="form-label" for="model">Model:</label>
                                <input type="text" class="form-control" name="item_model"/>
                            </div>
                            @endif

                            @if(strtolower($type) === 'beerashtrays' || strtolower($type) === 'beerplateaus' || strtolower($type) === 'beeradvertisements' || strtolower($type) === 'beercoasters' || strtolower($type) === 'beerstonejugs')
                            <div class="form-group">
                                <label class="form-label" for="material">Material:</label>
                                <input type="text" class="form-control" name="item_material"/>
                            </div>
                            @endif

                            @if(strtolower($type) === 'beercontainers' || strtolower($type) === 'beeradvertisements')
                            <div class="form-group">
                                <label class="form-label" for="year">Year:</label>
                                <input type="text" class="form-control" name="item_year"/>
                            </div>
                            @endif

                            @if(strtolower($type) === 'beerglasses' || strtolower($type) === 'beerlabels' || strtolower($type) === 'beerbottles' || strtolower($type) === 'beerplateaus' || strtolower($type) === 'beeradvertisements' || strtolower($type) === 'beercoasters' || strtolower($type) === 'beerstonejugs')
                            <div class="form-group">
                                <label class="form-label" for="language">Language:</label>
                                <input type="text" class="form-control" name="item_language"/>
                            </div>
                            @endif

                            @if(strtolower($type) === 'beerglasses' || strtolower($type) === 'beerbottles' || strtolower($type) === 'beerstonejugs')
                            <div class="form-group">
                                <label class="form-label" for="size">Size:</label>
                                <input type="text" class="form-control" name="item_size"/>
                            </div>
                            @endif

                            @if(strtolower($type) === 'beercontainers')
                            <div class="form-group">
                                <label class="form-label" for="boxes">Boxes:</label>
                                <input type="text" class="form-control" name="item_boxes"/>
                            </div>
                            @endif

                            <div class="form-group">
                                <label class="form-label" for="extra_1">Extra 1:</label>
                                <input type="text" class="form-control" name="item_extra_1"/>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="extra_2">Extra 2:</label>
                                <input type="text" class="form-control" name="item_extra_2"/>
                            </div>
                        </fieldset>
                    </div>
                </div>
            </div>
    </div>

</div>


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-orange"><b>Photo Material</b></div>
                    <div class="card-body">
                        <div class="form-group">
                        <label for="document">Images</label>
                        <div class="dropzone" id="documentDropzone">

                        </div>
                    </div>

                    </div>

            </div>
        </div>
    </div>
</form>
</div>


@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

    <script>
            $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });
    </script>





    <script>
        button.disabled = false;
        //document.getElementById("test").style.display = "none";
        var uploadedDocumentMap = {};
        Dropzone.options.documentDropzone = {
            url: '{{ route('image.store') }}',
            maxFiles: 8,
            maxFilesize: 10,
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            uploadMultiple: false,
            parallelUploads: 4,
            acceptedFiles: '.jpeg,.jpg,.png,.gif',
            timeout: 5000,

            success: function (file, response) {
                console.log(response);
                button.disabled = false;
                $('form').append('<input type="hidden" name="document[]" value="' + response.name + '">')
                uploadedDocumentMap[file.name] = response.name
                console.log(uploadedDocumentMap[file.name] );
            },
            removedfile: function (file) {
                file.previewElement.remove()
                var name = ''
                if (typeof file.file_name !== 'undefined') {
                    name = file.file_name
                } else {
                    name = uploadedDocumentMap[file.name]
                }
                $('form').find('input[name="document[]"][value="' + name + '"]').remove()
            },
            init: function () {
                @if(isset($beeritem) && $beeritem->document)
                    var files =
                    {!! json_encode($beeritem->document) !!}
                    for (var i in files) {
                    var file = files[i]
                    this.options.addedfile.call(this, file)
                    file.previewElement.classList.add('dz-complete')
                    $('form').append('<input type="hidden" name="document[]" value="' + file.file_name + '">')
                    }
                @endif
                }
            ,



            error: function(file, response) {
                //document.getElementById("test").style.display = "block";
                //document.getElementById("test").innerHTML = response;
                console.log(response);
                return false;
            }
        };



    </script>



@endsection

