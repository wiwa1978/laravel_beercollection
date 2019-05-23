
@extends('layouts.backend')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="col-md-12">@include('../flash-messages')</div>
                <div class="card">
                    <div class="card-header">Permission Details</div>
                    <div class="card-body">
                        <p>Name: {{ ucfirst($permission->name) }}</p>

                    </div>
                </div>
            </div>



    </div>
</div>
@endsection
