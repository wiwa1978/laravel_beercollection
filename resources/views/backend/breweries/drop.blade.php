
@extends('layouts.backend')

@section('css')
@endsection


@section('content')
<div class="container">
    <div class="row justify-content-center">
    <div class="col-md-12">@include('../flash-messages')</div>
        <div class="col-md-6">

                <div class="card">
                    <div class="card-header">Brewery Detail</div>
                    <div class="card-body">

                                    <div class="form-group">
                <select id="country" name="category_id" class="form-control" style="width:350px" >
                <option value="" selected disabled>Select</option>
                  @foreach($countries as $key => $country)
                  <option value="{{$key}}"> {{$country}}</option>
                  @endforeach
                  </select>
            </div>
            <div class="form-group">
                <label for="title">Select State:</label>
                <select name="region" id="region" class="form-control" style="width:350px">
                </select>
            </div>

            <div class="form-group">
                <label for="title">Select City:</label>
                <select name="city" id="city" class="form-control" style="width:350px">
                </select>
            </div>
      </div>
    </div>
</div>



                    </div>
                </div>
            </div>





    </div>
</div>
@endsection

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

