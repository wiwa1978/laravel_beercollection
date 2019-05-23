
@extends('layouts.backend')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="col-md-12">@include('../flash-messages')</div>
                <div class="card">
                    <div class="card-header">Role Details</div>
                    <div class="card-body">
                        <p>Name: {{ ucfirst($role->name) }}</p>
                        <p>Permissions:</p>
                            @foreach($role->permissions as $permission)
                                <span class="tag tag-green">{{ ucfirst($permission->name) }}</span>
                            @endforeach
                    </div>
                </div>
            </div>



    </div>
</div>
@endsection
