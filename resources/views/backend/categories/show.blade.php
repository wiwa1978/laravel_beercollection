
@extends('layouts.backend')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">@include('../flash-messages')</div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Beeritems belonging to Category "{{ $category->category_name }}"</div>
                        <div class="card-body">
                        @if($beeritems->isEmpty() || $beeritems->count() == 0)
                            <p>No beeritems defined yet for this category</p>
                        @else
                            <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                            <td align="center">@sortablelink('id')</td>
                                            <td>@sortablelink('beeritems_name')</td>
                                            <td>Description</td>
                                            <td>Tags</td>
                                            <td>Categories</td>
                                            <td colspan="3" align="center">Action</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($beeritems as $beeritem)
                                            <tr>
                                                <td width="5%" align="center">{{$beeritem->id}}</td>
                                                <td width="15%">{{$beeritem->item_name}}</td>
                                                <td width="15%">{{$beeritem->item_description}}</td>
                                                <td width="5%">
                                                @foreach($beeritem->tags as $tag)
                                                    <span class="tag tag-green">{{ $tag->tag_name }}</span>
                                                @endforeach
                                                </td>
                                                <td width="5%">

                                                    <span class="tag tag-orange">{{ $beeritem->category->category_name }}</span>

                                                </td>

                                                <td width="5%" align="center"><a href="{{ route('beeritems.edit',$beeritem->id)}}" class="btn btn-info btn-sm">Edit</a></td>
                                                <td width="5%" align="center"><a href="{{ route('beeritems.show',$beeritem->id)}}" class="btn btn-warning btn-sm">Show</a></td>
                                                <td width="5%" align="center">
                                                    <form action="{{ route('beeritems.destroy', $beeritem->id)}}" method="post">
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
            </div>
        </div>
    </div>
</div>
@endsection
