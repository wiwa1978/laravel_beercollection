@extends('layouts.backend')

@section('content')
<div class="container">
    <div class="row justify-content-center">
    <div class="col-md-12">@include('../flash-messages')</div>
        <div class="col-md-6">

                <div class="card">
                    <div class="card-header"><i class='fe fe-paperclip'></i>&nbsp &nbsp Create Permission </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('permissions.store') }}" >
                        @csrf

                        <div class="form-group">
                                <label for="name">Name:</label>
                                <input type="text" class="form-control" name="name" />
                            </div>


                            <div class="form-group">
                                <label for="roles">Assign Permission to Roles:</label>
                                @if(!$roles->isEmpty())
                                    @foreach($roles as $role)
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="roles[]" value={{ $role->id }}>
                                            <span class="custom-control-label">{{ ucfirst($role->name) }} </span>
                                         </label>
                                    @endforeach
                                @endif
                            </div>

                            <button type="submit" id="button" class="btn btn-primary">Add</button>
                        </form>


                    </div>
                </div>
            </div>


    </div>
</div>
@endsection

