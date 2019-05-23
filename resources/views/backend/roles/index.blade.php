@extends('layouts.backend')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">@include('../flash-messages')</div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Roles Overview</div>
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
                                        <form action="{{ route('roles.create')}}" method="get">
                                            @csrf
                                            <button class="btn btn-primary btn-sm" type="submit">Add Role</button>
                                        </form>
                                    </div>
                                </div>

                                <hr style="width: 98%; color: blue; height: 0.05px; background-color:red;" />
                                @if(!$roles->isEmpty() || !$roles->count() == 0)

                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">Roles Overview</h3>
                                        </div>
                                    <div class="card-body">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                <td align="center">@sortablelink('id')</td>
                                                <td>Name</td>
                                                <td>Description</td>
                                                <td>Permissions</td>
                                                <td>Created At</td>
                                                <td>Updated At</td>
                                                <td colspan="3" align="center">Action</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($roles as $role)
                                                <tr>
                                                    <td width="5%" align="center">{{$role->id}}</td>
                                                    <td width="20%">{{ ucfirst($role->name) }}</td>
                                                    <td width="20%">{{ $role->description }}</td>
                                                    <td width="15%">
                                                        @foreach($role->permissions as $permission)
                                                            @if(isset($permission))
                                                                <span class="tag tag-green">{{ ucfirst($permission->name) }}</span>
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                    <td width="10%">{{ $role->created_at->format('d-m-Y') }}</td>
                                                    <td width="10%">{{ $role->updated_at->format('d-m-Y') }}</td>
                                                    <td width="10%" align="center"><a href="{{ route('roles.show', $role->id) }}" class="btn btn-info btn-sm">Show</a></td>
                                                    <td width="10%" align="center"><a href="{{ route('roles.edit', $role->id) }}" class="btn btn-warning btn-sm">Edit</a></td>
                                                    <td width="10%" align="center">
                                                        <form action="{{ route('roles.destroy', $role->id)}}" method="post">
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
                                        <h3 class="card-title">Role Overview</h3>
                                    </div>
                                    <div class="card-body">
                                        No objects yet
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
@endsection




