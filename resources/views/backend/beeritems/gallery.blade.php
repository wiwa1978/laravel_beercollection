
@extends('layouts.backend')

@section('content')

<div class="container">
    @include('../flash-messages')
    <div class="row row-cards">
        <div class="col-12  ">

            <div class="card">
                <div class="card-header">
                    <h3 class="h3 m-0 text-gray">Photo Gallery</h3>
                </div>
            </div>

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
                         {{ $media->links() }}
                         <div class="row">
                            @foreach($media as $media_item)
                                <div class="col-md-3">
                                    <div class="card">
                                        <a href="{{ asset('storage/'. $media_item->id.'/'.$media_item->file_name) }}">
                                            <img class="card-img-top" src="{{ asset('storage/'.$media_item->id .'/'. $media_item->file_name)  }}" ">
                                        </a>
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



