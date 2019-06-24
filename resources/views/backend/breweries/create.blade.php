
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
                                <select name="brewery_province" id="state" class="form-control" style="width:350px">
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















                        </fieldset>
                    </div>
                </div>
            </div>


            {{-- Rechterkant --}}
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-orange"><b>Additional information</b></div>

                    <div class="card-body">

                        <fieldset class="form-fieldset">
                            <div class="form-group">
                                <label class="form-label" for="description">History</label>
                                <textarea rows="5" id="ticket_description" class="form-control" name="ticket_description" value="{{ old('ticket_description') }}"></textarea>

                            </div>


                            <div class="form-group">
                                <label class="form-label" for="document">Images</label>
                                <div class="dropzone" id="breweryDropzone">
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

   <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>


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
           url:"{{url('get-state-list')}}?country_id="+countryID,
           success:function(res){
            if(res){
                $("#state").empty();
                $("#state").append('<option>Select</option>');
                $.each(res,function(key,value){
                    $("#state").append('<option value="'+key+'">'+value+'</option>');
                });

            }else{
               $("#state").empty();
            }
           }
        });
    }else{
        $("#state").empty();
        $("#city").empty();
    }
   });
    $('#state').on('change',function(){
    var stateID = $(this).val();
    console.log(stateID);
    if(stateID){
        $.ajax({
           type:"GET",
           url:"{{url('get-city-list')}}?state_id="+stateID,
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
    <script>
        button.disabled = false;
        //document.getElementById("test").style.display = "none";
        var uploadedDocumentMap = {};
        Dropzone.options.breweryDropzone = {
            url: '{{ route('brewery.image.store') }}',
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
                @if(isset($brewery) && $brewery->document)
                    var files =
                    {!! json_encode($brewery->document) !!}
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

