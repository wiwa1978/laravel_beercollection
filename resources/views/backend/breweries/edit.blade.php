
@extends('layouts.backend')

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/min/dropzone.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.css">

@endsection


@section('content')
<div class="container">
    <div class="row justify-content-center">
    <div class="col-md-12">@include('../flash-messages')</div>
        <div class="col-md-6">

                <div class="card">
                    <div class="card-header">Brewery Detail</div>
                    <div class="card-body">
                        <form method="post" action="{{ route('breweries.update', $brewery->id) }}" enctype="multipart/form-data">
                          @method('PUT')
                          @csrf

                            <div class="form-group">
                                <label class="form-label" for="name">Brewery Name:</label>
                                <input type="text" class="form-control" name="brewery_name" value="{{ $brewery->brewery_name }}"/>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="description">Brewery Description:</label>
                                <input type="text" class="form-control" name="brewery_description" value="{{ $brewery->brewery_description }}"/>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="description">Brewery Zipcode:</label>
                                <input type="text" class="form-control" name="brewery_zipcode" value="{{ $brewery->brewery_zipcode }}"/>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="description">Brewery Town:</label>
                                <input type="text" class="form-control" name="brewery_town" value="{{ $brewery->brewery_town }}"/>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="description">Brewery SubTown:</label>
                                <input type="text" class="form-control" name="brewery_subtown" value="{{ $brewery->brewery_subtown }}"/>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="description">Brewery Province:</label>
                                <input type="text" class="form-control" name="brewery_province" value="{{ $brewery->brewery_province }}"/>
                            </div>

                             <div class="form-group">
                                <label class="form-label" for="description">Brewery Country:</label>
                                <input type="text" class="form-control" name="brewery_country" value="{{ $brewery->brewery_country }}"/>
                            </div>

                            <div class="btn-list">
                                <button type="submit" id="button" class="btn btn-success">Save changes</button>
                                <a href="{{ route('breweries.index') }}" class="btn btn-danger btn-close">Cancel</a>
                            </div>



                        </form>

                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Brewery Photos</div>
                    <label id="test">One or more files is exceeding largest filesize</label>
                    <div class="card-body">
                        <form  method="post" action="{{ route('image.store') }}" enctype="multipart/form-data" class="dropzone" id="dropzone">
                        @csrf

                        </form>
                    </div>
                </div>
            </div>



    </div>
</div>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.js"></script>
    <script src="{{ asset('js/dropzone.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

    <script>
            $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });
    </script>



@endsection

