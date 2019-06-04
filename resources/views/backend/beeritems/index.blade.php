
@extends('layouts.backend')

@section('content')

<div class="container">
    @include('../flash-messages')
    <div class="row row-cards">
        <div class="col-12  ">
            <form method="post" action="{{ route('beeritems.store') }}" enctype="multipart/form-data">
                    @csrf
            <div class="card">
                <div class="card-header">
                    @if($spare)
                        <h3 class="h3 m-0 text-gray">{{ $type }} Overview - Spares</h3>
                    @elseif($wishlist)
                        <h3 class="h3 m-0 text-gray">{{ $type }} Overview - Wishlist</h3>
                    @elseif($search)
                        <h3 class="h3 m-0 text-gray">{{ $type }} Overview - Search results for '{{ $q }}'</h3>
                    @else
                        <h3 class="h3 m-0 text-gray">{{ $type }} Overview</h3>
                    @endif


                    <div class="card-options">
    	                @if( strtolower($type) != 'beeritems' )
                        <a href="{{ route('beeritems.create',['item_type' => $type ]) }}" class="btn btn-primary">Create {{ $type }}</a>
                        @else
                        <a href="{{ route('beeritems.create') }}" class="btn btn-primary">Create {{ $type }}</a>
                        @endif
                    </div>

                </div>
            </div>
            </form>
        </div>
    </div>
</div>


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12"></div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <form action="{{ route('beeritems.search', ['item_type' => $type ]) }}" method="POST" role="search">
                             @csrf
                            <div class="input-group input-icon mb-3">
                                <input type="text" class="form-control" name="q" placeholder="Search..."> <span class="input-group-btn">
                                    <button type="submit" class="btn btn-default">
                                        <span class="input-icon-addon">
                                            <i class="fe fe-search"></i>
                                        </span>
                                    </button>
                                </span>
                            </div>
                        </form>
                    </div>
                <div class="row align-items-center">
                    @if(!$beeritems->isEmpty())
                    <div class="col-md-12">
                    <div class="table-responsive-xl">
                        <table class="table table-bordered ">
                            <thead>
                                <tr>
                                <td align="center">@sortablelink('id')</td>
                                <td>@sortablelink('item_name')</td>
                                <td>Brewery</td>
                                <td>Collection</td>
                                <td>Amount</td>
                                <td>Tags</td>
                                <td>Category</td>
                                <td align="center">Action</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($beeritems as $beeritem)
                                <tr>
                                    <td align="center">{{$beeritem->id}}</td>
                                    <td><a href="{{ route('beeritems.show', $beeritem->id)}}">{{$beeritem->item_name}}</a>

                                    <td>{{$beeritem->brewery->brewery_name}}</td>
                                    <td>{{$beeritem->collection->collection_name}}</td>
                                    <td align="center">{{$beeritem->item_amount}}</td>
                                    <td>
                                    @if(!$beeritem->tags->isEmpty())
                                        @foreach($beeritem->tags as $tag)
                                            <a href="{{ route('tags.show', $tag->id)}}" class="tag tag-green">{{ $tag->tag_name }}</span>
                                        @endforeach
                                    @else
                                        <span class="tag tag-red">No tags </span>
                                    @endif
                                    </td>
                                    <td>{{$beeritem->category->category_name}}</td>
                                    <td align="center">
                                        <div class="dropdown">
                                            <button type="button" class="btn btn-outline-success dropdown-toggle" data-toggle="dropdown">
                                                <i class="fe fe-calendar mr-2"></i>Actions
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item text-orange" href="{{ route('beeritems.edit',$beeritem->id)}}">Edit</a>
                                                <a class="dropdown-item text-blue" href="{{ route('beeritems.show',$beeritem->id)}}">Show</a>
                                                 <form action="{{ route('beeritems.destroy', $beeritem->id)}}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="dropdown-item text-red" type="submit">Delete</button>
                                                </form>

                                            </div>
                                        </div>
                                    </td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        </div>
                    </div>
                    @else
                    <div class="col-md-12">
                        <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">{{ $type }} Overview</h3>
                                </div>
                                <div class="card-body">
                                    No {{ strtolower($type) }} yet
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
</div>
@endsection



