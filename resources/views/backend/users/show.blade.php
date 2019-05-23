
@extends('layouts.backend')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="col-md-12">@include('../flash-messages')</div>
                <div class="card">
                    <div class="card-header">User Details</div>
                    <div class="card-body">
                        <p>Name: {{$user->name}}</p>
                        <p>Email: {{$user->email}}</p>
                        <p>Created at: {{ $user->created_at->format('d-m-Y \a\t h:i:s') }}</p>
                        <p>Updated at: {{ $user->updated_at->format('d-m-Y \a\t h:i:s') }}</p>
                        <p>Roles:</p>
                            @foreach($user->roles as $role)
                                <span class="tag tag-green">{{ $role->name }}</span>
                            @endforeach

                    </div>
                </div>
            </div>



    </div>
</div>
@endsection
