
@extends('layouts.backend')

@section('content')
<div class="container">
    <div class="row justify-content-center">
    <div class="col-md-12">@include('../flash-messages')</div>
        <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Categories</div>
                    <div class="card-body">
                        @if($categories->isEmpty() || $categories->count() == 0)
                            <p>No categories defined</p>
                        @else
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <td>ID</td>
                                        <td>Name</td>
                                        <td>Description</td>
                                        <td align="center">Action</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($categories as $category)
                                    <tr>
                                        <td width="10%">{{$category->id}}</td>
                                        <td width="40%"> <a href="{{ route('categories.show',$category->id)}}">{{$category->category_name}}</a>


                                        </td>
                                        <td width="40%">{{$category->category_description}}</td>
                                        <td width="10%" align="center">
                                    <form action="{{ route('categories.destroy', $category->id)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                                    </form>
                                </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Add Categories</div>
                    <div class="card-body">
                        <form method="post" action="{{ route('categories.store') }}" >
                        @csrf
                        <div class="form-group">
                                <label for="name">Category Name:</label>
                                <input type="text" class="form-control" name="category_name"/>
                            </div>
                             <div class="form-group">
                                <label for="name">Category Description:</label>
                                <input type="text" class="form-control" name="category_description"/>
                            </div>
                            <button type="submit" id="button" class="btn btn-primary">Add Category</button>
                        </form>
                    </div>
                </div>
            </div>
    </div>
</div>
@endsection
