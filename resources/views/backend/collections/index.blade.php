
@extends('layouts.backend')

@section('content')
<div class="container">
    <div class="row justify-content-center">
    <div class="col-md-12">@include('../flash-messages')</div>
        <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Collections</div>
                    <div class="card-body">
                        @if($collections->isEmpty() || $collections->count() == 0)
                            <p>No collections defined</p>
                        @else
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <td>ID</td>
                                        <td>Name</td>
                                        <td>Type</td>
                                        <td align="center">Action</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($collections as $collection)
                                    <tr>
                                        <td width="10%">{{$collection->id}}</td>


                                        <td width="60%"> <a href="{{ route('collections.show',$collection->id)}}">{{$collection->collection_name}}</a>


                                        </td>
                                        <td width="20%">{{$collection->collection_type}}</td>
                                        <td width="10%" align="center">
                                    <form action="{{ route('collections.destroy', $collection->id)}}" method="post">
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
                    <div class="card-header">Add Collections</div>
                    <div class="card-body">
                        <form method="post" action="{{ route('collections.store') }}" >
                        @csrf
                        <div class="form-group">
                                <label for="name">Collection Name:</label>
                                <input type="text" class="form-control" name="collection_name"/>
                            </div>
                            <div class="form-group">
                                <label for="name">Collection Description:</label>
                                <input type="text" class="form-control" name="collection_description"/>
                            </div>

                            <div class="form-group">
                            <label for="name">Collection Type:</label>
                                <select class="form-control m-bot15" name="collection_type">

                                    @foreach($collection_types as $collection_type)
                                        <option value="{{$collection_type}}">{{$collection_type}}</option>
                                    @endForeach

                                </select>
                            </div>

                            <button type="submit" id="button" class="btn btn-primary">Add Collection</button>
                        </form>
                    </div>
                </div>
            </div>
    </div>
</div>
@endsection
