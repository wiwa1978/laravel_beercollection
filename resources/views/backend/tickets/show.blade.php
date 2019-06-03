
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
            <form method="post" action={{ url('/new_ticket') }} enctype="multipart/form-data">
            @csrf
            <div class="card">
                <div class="card-header">
                    <h3 class="h3 m-0 text-gray">Show Ticket '{{ $ticket->id }}' with ID '{{ $ticket->ticket_id }}'</h3>
                    <div class="card-options">
                        <button type="submit" id="button" class="btn btn-success">Save changes</button>
                        <a href="{{ route('tickets.create') }}" class="btn btn-danger btn-close ml-2">Cancel</a>
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
                    <div class="card-header text-orange"><b>Ticket Classification</b></div>
                    <div class="card-body">




                            <div class="form-group">
                                <label for="ticket_title" class="form-label">Title:</label>
                                <input id="ticket_title" type="text" class="form-control" readonly name="ticket_title" value="{{ $ticket->ticket_title }}">
                            </div>

                             <div class="form-group{{ $errors->has('ticket_title') ? ' has-error' : '' }}">
                                <label for="ticket_type" class="form-label">Ticket Type:</label>

                                <input id="ticket_type" type="text" class="form-control" readonly name="ticket_type" value="{{ $ticket_type->type_name }}">




                            </div>

                            <div class="form-group{{ $errors->has('ticket_priority') ? ' has-error' : '' }}">
                                <label for="priority" class="form-label">Ticket Priority:</label>

                                 <input id="ticket_priority" type="text" class="form-control" readonly name="ticket_priority" value="{{ $ticket->ticket_priority }}">


                            </div>











                    </div>
                </div>
            </div>


            {{-- Rechterkant --}}
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-orange"><b>Ticket Information</b></div>

                    <div class="card-body">
                            <label for="ticket_created" class="form-label">Ticket created: {{ $ticket->created_at->diffForHumans() }}</label>

                                 <div
                            <label for="status" class="form-label">Ticket Status:</label>
                                @if ($ticket->ticket_status === 'Open')
                                <span class="tag tag-red">{{ $ticket->ticket_status }}</span>
                            @else
                                <span class="tag tag-green">{{ $ticket->ticket_status }}</span>
                            @endif
                        </div>

                            <div class="form-group{{ $errors->has('ticket_description') ? ' has-error' : '' }}">
                            <label for="ticket_description" class="form-label">Description:</label>
                            <textarea rows="9" id="ticket_description" readonly class="form-control" name="ticket_description" value="{{ old('ticket_description') }}"></textarea>



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
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-orange"><b>Comments</b></div>
                    <div class="card-body">

                        <div class="comment-form">
                        <form action="{{ url('comment') }}" method="POST" class="form">
                            {!! csrf_field() !!}

                            <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">

                            <div class="form-group{{ $errors->has('comment') ? ' has-error' : '' }}">
                                <textarea rows="10" id="comment" class="form-control" name="comment"></textarea>

                                @if ($errors->has('comment'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('comment') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
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

