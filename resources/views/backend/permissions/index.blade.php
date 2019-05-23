@extends('layouts.backend')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">@include('../flash-messages')</div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Permission Overview</div>
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
                                        <form action="{{ route('permissions.create')}}" method="get">
                                        @csrf
                                            <button class="btn btn-primary btn-sm" type="submit">Add Permissions</button>
                                        </form>
                                    </div>
                                </div>

                        <hr style="width: 98%; color: blue; height: 0.05px; background-color:red;" />
                        @if(!$permissions->isEmpty() || !$permissions->count() == 0)

                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Permission Overview</h3>
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                            <td align="center">@sortablelink('id')</td>
                                            <td>@sortablelink('name')</td>
                                            <td>Description</td>
                                            <td>Created At</td>
                                            <td>Updated At</td>
                                            <td colspan="3" align="center">Action</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($permissions as $permission)
                                            <tr>
                                                <td width="5%" align="center">{{$permission->id}}</td>
                                                <td width="20%">{{ ucfirst($permission->name) }}</td>
                                                <td width="20%">{{ $permission->description }}</td>
                                                <td width="10%">{{ $permission->created_at->format('d-m-Y') }}</td>
                                                <td width="10%">{{ $permission->updated_at->format('d-m-Y') }}</td>
                                                <td width="10%" align="center"><a href="{{ route('permissions.show', $permission->id) }}" class="btn btn-info btn-sm">Show</a></td>
                                                <td width="10%" align="center"><a href="{{ route('permissions.edit', $permission->id) }}" class="btn btn-warning btn-sm">Edit</a></td>
                                                <td width="10%" align="center">
                                                    <form action="{{ route('permissions.destroy', $permission->id)}}" method="post">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


