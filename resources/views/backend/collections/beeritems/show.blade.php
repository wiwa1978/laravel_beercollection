
@extends('layouts.backend')

@section('content')
<div class="container">
    <div class="row justify-content-center">
    <div class="col-md-12">@include('../flash-messages')</div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{$name}} Overview</div>
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


                        @if(!$beeritems->isEmpty() || !$beeritems->count() == 0)
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">{{ $name }} Overview</h3>
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                            <td align="center">@sortablelink('id')</td>
                                            <td>@sortablelink('item_name')</td>
                                            <td>Brewery</td>
                                            <td>Collection</td>
                                            <td>Tags</td>
                                            <td>Category</td>
                                            <td colspan="3" align="center">Action</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($beeritems as $beeritem)
                                            <tr>
                                                <td width="5%" align="center">{{$beeritem->id}}</td>
                                                <td width="15%"><a href="{{ route('beeritems.show', $beeritem->id)}}">{{$beeritem->item_name}}</a>

                                                <td width="15%">{{$beeritem->brewery->brewery_name}}</td>
                                                <td width="15%">{{$beeritem->collection->collection_name}}</td>
                                                <td width="5%">
                                                @if(!$beeritem->tags->isEmpty() || !$beeritem->tags->count() == 0)
                                                    @foreach($beeritem->tags as $tag)
                                                        <a href="{{ route('tags.show', $tag->id)}}" class="tag tag-green">{{ $tag->tag_name }}</span>
                                                    @endforeach
                                                @else
                                                   <span class="tag tag-red">No tags </span>
                                                @endif
                                                </td>
                                                <td width="5%">
                                                    <a href="{{ route('categories.show', $beeritem->category->id)}}" class="tag tag-orange">{{ $beeritem->category->category_name }}</span>
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
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">{{ $name }} Overview</h3>
                                </div>
                                <div class="card-body">
                                    No {{ strtolower($name) }} yet
                                </div>
                            </div>
                        </div>
                    @endif
                    {!! $beeritems->appends(\Request::except('page'))->render() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script src="{{ asset('js/search.js') }}" defer></script>

    <script type="text/javascript">
        var searchURL = "{{ route('beeritems.search') }}";
    </script>




@endsection


