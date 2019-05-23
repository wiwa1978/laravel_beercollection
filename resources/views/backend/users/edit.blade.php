
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
                    <div class="card-header"><i class='fe fe-user-plus'></i>&nbsp &nbsp Update User </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('users.update', $user->id) }}" >
                        @method('PUT')
                        @csrf

                        <div class="form-group">
                                <label for="name">Name:</label>
                                <input type="text" class="form-control" name="name" value="{{ $user->name }}"/>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" name="email" value="{{ $user->email }}"/>
                            </div>

                            <!--
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" name="password"/>
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation">Confirm Password</label>
                                <input type="password" class="form-control" name="password_confirmation"/>
                            </div>
                            -->
                            <div class="form-group">
                                <label for="roles">Roles:</label>
                                    @foreach($roles as $role)
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="roles[]" value={{ $role->id }}>
                                            <span class="custom-control-label">{{ $role->name }} </span>
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

@section('scripts')

@endsection

