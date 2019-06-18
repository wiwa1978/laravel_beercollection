
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
                    <h3 class="h3 m-0 text-gray">QR-code for '{{ $beeritem->item_name }}'</h3>
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




                        <div class="form-group">
                            <label class="form-label" for="name">Name:</label>
                            <input type="text" readonly class="form-control" name="item_name" value="{{ $beeritem->item_name }}"/>
                        </div>




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


            {{-- Rechterkant --}}
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-orange"><b>QR-code</b></div>

                    <div class="card-body">

                        <div class="form-group text-center">
                            {!! QrCode::size(400)->generate( $msg ); !!}

                        </div>
                        <div>
                             <a download="test.png"><img src=href="{!! base64_encode(QrCode::format('png')->size(200)->generate('A simple example of QR code'))!!}"</a>
                        </div>

                    </div>
                </div>
            </div>
    </div>
</div>





@endsection


