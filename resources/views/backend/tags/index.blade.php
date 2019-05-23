
@extends('layouts.backend')

@section('content')
<div class="container">
    <div class="row justify-content-center">
    <div class="col-md-12">@include('../flash-messages')</div>
        <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Tags</div>
                    <div class="card-body">
                        @if($tags->isEmpty() || $tags->count() == 0)
                            <p>No tags defined</p>
                        @else
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <td>ID</td>
                                        <td>Name</td>
                                        <td colspan="2" align="center">Action</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($tags as $tag)
                                    <tr>
                                        <td width="10%">{{$tag->id}}</td>

                                        <td width="50%"><a href="{{ route('tags.show',$tag->id)}}">{{$tag->tag_name}}</td>
                                        <td width="10%" align="center">
                                    <form action="{{ route('tags.destroy', $tag->id)}}" method="post">
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
                    <div class="card-header">Add tags</div>
                    <div class="card-body">
                        <form method="post" action="{{ route('tags.store') }}" >
                        @csrf
                        <div class="form-group">
                                <label for="name">Tag Name:</label>
                                <input type="text" class="form-control" name="name"/>
                            </div>
                            <button type="submit" id="button" class="btn btn-primary">Add</button>
                        </form>
                    </div>
                </div>
            </div>
    </div>
</div>
@endsection
