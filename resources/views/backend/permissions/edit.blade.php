@extends('layouts.backend')

@section('content')
<div class="container">
    <div class="row justify-content-center">
    <div class="col-md-12">@include('../flash-messages')</div>
        <div class="col-md-6">

                <div class="card">
                    <div class="card-header"><i class='fe fe-paperclip'></i>&nbsp &nbsp Update Permission </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('permissions.update', $permission->id) }}" >
                        @method('PUT')
                                @csrf

                        <div class="form-group">
                                <label for="name">Name:</label>
                                <input type="text" class="form-control" name="name" value={{ ucfirst($permission->name) }} >
                            </div>

                              <div class="form-group">
                                <label for="name">Description:</label>
                                <input type="text" class="form-control" name="description" value={{ ucfirst($permission->description) }} >
                            </div>



                            <button type="submit" id="button" class="btn btn-primary">Update</button>
                        </form>


                    </div>
                </div>
            </div>


    </div>
</div>
@endsection

