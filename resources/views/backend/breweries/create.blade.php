
@extends('layouts.backend')

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/min/dropzone.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" />

@endsection


@section('content')

<div class="container">
    <div class="row row-cards">
        <div class="col-12  ">
            <form method="post" action={{ route('breweries.store') }} enctype="multipart/form-data">
            @csrf
            <div class="card">
                <div class="card-header">
                    <h3 class="h3 m-0 text-gray">Creating Brewery</h3>
                    <div class="card-options">
                        <button type="submit" id="button" class="btn btn-success">Save changes</button>
                        <a href="{{ route('breweries.create') }}" class="btn btn-danger btn-close ml-2">Cancel</a>
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
                    <div class="card-header text-orange"><b>Brewery Information</b></div>
                    <div class="card-body">


                        <fieldset class="form-fieldset">

                                 <form method="post" action="{{ route('breweries.store') }}" enctype="multipart/form-data">
                        @csrf

                            <div class="form-group">
                                <label class="form-label" for="name">Brewery Name:</label>
                                <input type="text" class="form-control" name="brewery_name" value="{{ old('brewery_name') }}"/>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="description">Brewery Description:</label>
                                <input type="text" class="form-control" name="brewery_description" value="{{ old('brewery_description') }}"/>
                            </div>














                        </fieldset>
                    </div>
                </div>
            </div>


            {{-- Rechterkant --}}
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-orange"><b>Brewery Address</b></div>

                    <div class="card-body">

                        <fieldset class="form-fieldset">

                                                <div class="form-group">
                                <label class="form-label" for="description">Country:</label>
                                <select name="brewery_country" id="country" class="form-control" style="width:350px" >
                                    <option value="" selected disabled></option>
                                        @foreach($countries as $key => $country)
                                    <option value="{{$key}}"> {{$country}}</option>
                                @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="description">Region:</label>
                                <select name="brewery_province" id="region" class="form-control" style="width:350px">
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="description">City:</label>
                                <select name="brewery_town" id="city" class="form-control" style="width:350px">
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="description">Zipcode:</label>
                                <input type="text" class="form-control" name="brewery_zipcode" value="{{ old('brewery_zipcode') }}"/>
                            </div>


                        </form>


                        </fieldset>


                    </div>
                </div>
            </div>
    </div>
</div>



</form>
</div>


@endsection

@section('scripts')
@section('scripts')
<script
  src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous">
</script>

<script type="text/javascript">
    $('#country').change(function(){
    var countryID = $(this).val();
    if(countryID){
        $.ajax({
           type:"GET",
           url:"{{url('get-region-list')}}?country_id="+countryID,
           success:function(res){
            if(res){
                $("#region").empty();
                $("#region").append('<option>Select</option>');
                $.each(res,function(key,value){
                    $("#region").append('<option value="'+key+'">'+value+'</option>');
                });

            }else{
               $("#region").empty();
            }
           }
        });
    }else{
        $("#region").empty();
        $("#city").empty();
    }
   });
    $('#region').on('change',function(){
    var regionID = $(this).val();
    console.log(regionID);
    if(regionID){
        $.ajax({
           type:"GET",
           url:"{{url('get-city-list')}}?region_id="+regionID,
           success:function(res){
            if(res){
                $("#city").empty();
                $.each(res,function(key,value){
                    $("#city").append('<option value="'+key+'">'+value+'</option>');
                });

            }else{
               $("#city").empty();
            }
           }
        });
    }else{
        $("#city").empty();
    }

   });
</script>

@endsection

