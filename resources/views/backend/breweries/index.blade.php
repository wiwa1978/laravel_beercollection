
@extends('layouts.backend')

@section('content')

<div class="container">
    @include('../flash-messages')
    <div class="row row-cards">
        <div class="col-12  ">
            <form method="post" action="{{ route('breweries.store') }}" enctype="multipart/form-data">
                    @csrf
            <div class="card">
                <div class="card-header">
                    @if($search)
                        <h3 class="h3 m-0 text-gray">Overview - Search results for '{{ $q }}'</h3>
                    @else
                        <h3 class="h3 m-0 text-gray">Brewery Overview</h3>
                    @endif



                    <div class="card-options">
                        <a href="{{ route('breweries.create') }}" class="btn btn-primary">Create brewery</a>
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
                        <form action="{{ route('breweries.search') }}" method="POST" role="search">
                             @csrf
                            <div class="input-group input-icon mb-3">
                                <input type="text" class="form-control" name="q"
                                    placeholder="Search..."> <span class="input-group-btn">
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
                    @if(!$breweries->isEmpty() || !$breweries->count() == 0)
                    <div class="col-md-12">
                    <div class="table-responsive-xl">
                        <table class="table table-bordered ">
                            <thead>
                                <tr>
                                    <td align="center">@sortablelink('id')</td>
                                    <td>@sortablelink('brewery_name')</td>
                                    <td>Description</td>
                                    <td>Town</td>
                                    <td>Country</td>
                                    <td colspan="3" align="center">Action</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($breweries as $brewery)
                                    <tr>
                                        <td align="center">{{$brewery->id}}</td>
                                        <td><a href="{{ route('breweries.show', $brewery->id)}}">{{$brewery->brewery_name}}</a>
                                        <td>{{$brewery->brewery_description}}</td>
                                        <td>{{$brewery->brewery_town}}</td>
                                        <td>{{$brewery->brewery_country}}</td>

                                        <td align="center">
                                            <div class="dropdown">
                                                <button type="button" class="btn btn-outline-success dropdown-toggle" data-toggle="dropdown">
                                                    <i class="fe fe-calendar mr-2"></i>Actions
                                                </button>

                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item text-orange" href="{{ route('breweries.edit',$brewery->id)}}">Edit</a>
                                                    <a class="dropdown-item text-blue" href="{{ route('breweries.show',$brewery->id)}}">Show</a>
                                                    <form action="{{ route('breweries.destroy', $brewery->id)}}" method="post">
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
                                    <h3 class="card-title">Brewery Overview</h3>
                                </div>
                                <div class="card-body">
                                    No breweries yet
                                </div>
                            </div>
                    </div>
                    @endif
                    {!! $breweries->appends(\Request::except('page'))->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


