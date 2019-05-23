@extends('layouts.backend')

@section('content')
<div class="container">
    <div class="row justify-content-center">
    <div class="col-md-12">@include('../flash-messages')</div>
        <div class="col-md-6">

                <div class="card">
                    <div class="card-header"><i class='fe fe-paperclip'></i>&nbsp &nbsp Create Role </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('roles.store') }}" >
                        @csrf

                        <div class="form-group">
                                <label for="name">Name:</label>
                                <input type="text" class="form-control" name="name"/>
                            </div>


                            <div class="form-group">
                                <label for="roles">Assign Permissions to Roles:</label>
                                    @foreach($permissions as $permission)
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="permissions[]" value={{ $permission->id }}>
                                            <span class="custom-control-label">{{ $permission->name }} </span>
                                         </label>
                                    @endforeach
                            </div>

                            <button type="submit" id="button" class="btn btn-primary">Add</button>
                        </form>


                    </div>
                </div>
            </div>


    </div>
</div>
@endsection

