
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
            <form method="post" action={{ route('tickets.store') }} enctype="multipart/form-data">
            @csrf
            <div class="card">
                <div class="card-header">
                    <h3 class="h3 m-0 text-gray">Creating Tickets</h3>
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


                        <fieldset class="form-fieldset">


                            <div class="form-group{{ $errors->has('ticket_title') ? ' has-error' : '' }}">
                                <label for="ticket_title" class="form-label">Title:</label>
                                <input id="ticket_title" type="text" class="form-control" name="ticket_title" value="{{ old('ticket_title') }}">


                            </div>

                             <div class="form-group{{ $errors->has('ticket_title') ? ' has-error' : '' }}">
                                <label for="ticket_type" class="form-label">Ticket Type:</label>
                                <select id="ticket_type" type="ticket_type" class="form-control" name="ticket_type">
                                    <option value="">Select Type</option>
                                    @foreach ($ticket_types as $ticket_type)
                                        <option value="{{ $ticket_type->id }}" {{ old("ticket_type") == $ticket_type->id ? "selected" : "" }}>{{ $ticket_type->type_name }}</option>
                                    @endforeach
                                </select>


                            </div>

                            <div class="form-group{{ $errors->has('ticket_priority') ? ' has-error' : '' }}">
                                <label for="priority" class="form-label">Ticket Priority:</label>
                                <select id="ticket_priority" type="" class="form-control" name="ticket_priority">
                                    <option value="">Select Priority</option>
                                    <option value="Low" {{ old("ticket_priority") == "Low" ? "selected" : "" }}>Low</option>
                                    <option value="Medium" {{ old("ticket_priority") == "Medium" ? "selected" : "" }}>Medium</option>
                                    <option value="High" {{ old("ticket_priority") == "High" ? "selected" : "" }}>High</option>
                                </select>


                            </div>







                        </fieldset>
                    </div>
                </div>
            </div>


            {{-- Rechterkant --}}
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-orange"><b>Ticket Information</b></div>

                    <div class="card-body">

                        <fieldset class="form-fieldset">

                            <div class="form-group{{ $errors->has('ticket_description') ? ' has-error' : '' }}">
                            <label for="ticket_description" class="form-label">Description:</label>


                                <textarea rows="8" id="ticket_description" class="form-control" name="ticket_description" value="{{ old('ticket_description') }}"></textarea>



                        </div>




                        </fieldset>


                    </div>
                </div>
            </div>
    </div>
</div>



</form>
</div>


@endsection








