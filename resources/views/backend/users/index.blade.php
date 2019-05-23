
@extends('layouts.backend')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">@include('../flash-messages')</div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">User Overview</div>
                        <div class="card-body">
                            <div class="form-group">
                                <div class="input-icon mb-3">
                                    <input type="text" class="form-control" id="search" name="search" placeholder="Search for..."/>
                                    <span class="input-icon-addon">
                                        <i class="fe fe-search"></i>
                                    </span>
                                </div>
                            </div>

                            <div class="row align-items-center">
                                <div class="d-flex">
                                    <div class="mr-auto p-2">
                                        <form action="{{ route('users.create')}}" method="get">
                                            @csrf
                                            <button class="btn btn-primary btn-sm" type="submit">Add Users</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <hr style="width: 98%; color: blue; height: 0.05px; background-color:red;" />
                            @if(!$users->isEmpty() || !$users->count() == 0)
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">User Overview</h3>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                <td align="center">@sortablelink('id')</td>
                                                <td>@sortablelink('name')</td>
                                                <td>Email</td>
                                                <td>Roles</td>
                                                <td>Permissions</td>
                                                <td colspan="3" align="center">Action</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($users as $user)
                                                <tr>
                                                    <td width="5%" align="center">{{$user->id}}</td>
                                                    <td width="20%">{{ $user->name }}</td>
                                                    <td width=15%">{{ $user->email }}</td>
                                                        <td width="15%">
                                                            @foreach($user->roles as $role)
                                                                <span class="tag tag-green">{{ $role->name }}</span>
                                                            @endforeach
                                                        </td>
                                                        <td width="15%">
                                                            @foreach($user->getAllPermissions() as $permission)
                                                                <span class="tag tag-blue">{{ $permission->name }}</span>
                                                            @endforeach
                                                        </td>

                                                    <td width="10%" align="center"><a href="{{ route('users.show', $user->id) }}" class="btn btn-info btn-sm">Show</a></td>
                                                    <td width="10%" align="center"><a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm">Edit</a></td>
                                                    <td width="10%" align="center">
                                                        <form action="{{ route('users.destroy', $user->id)}}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            @else
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Permission Overview</h3>
                                    </div>
                                    <div class="card-body">
                                        No objects yet
                                    </div>
                                </div>
                            </div>
                            @endif

                    {!! $users->appends(\Request::except('page'))->render() !!}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection


