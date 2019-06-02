
@extends('layouts.backend')

@section('content')

<div class="container">
    @include('../flash-messages')
    <div class="row row-cards">
        <div class="col-12  ">
            <form method="post" action="{{ route('tickets.store') }}" enctype="multipart/form-data">
                    @csrf
            <div class="card">
                <div class="card-header">
                    <h3 class="h3 m-0 text-gray">Ticket Overview</h3>

                    <div class="card-options">
                        <a href="{{ route('tickets.create') }}" class="btn btn-primary">Create ticket</a>
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

                <div class="row align-items-center">
                    @if(!$tickets->isEmpty() || !$tickets->count() == 0)
                    <div class="col-md-12">
                    <div class="table-responsive-xl">
                        <table class="table table-bordered ">
                            <thead>
                                <tr>
                                <td align="center">@sortablelink('id')</td>
                                <td>Name</td>
                                <td>Type</td>
                                <td align="center">Action</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tickets as $ticket)
                                <tr>
                                    <td align="center">{{$ticket->id}}</td>
                                    <td><a href="{{ route('ticket.show', $ticket->id)}}">{{$ticker->ticket_name}}</a>
                                    <td>{{$ticket->type}}</td>
                                    <td align="center">
                                        <div class="dropdown">
                                            <button type="button" class="btn btn-outline-success dropdown-toggle" data-toggle="dropdown">
                                                <i class="fe fe-calendar mr-2"></i>Actions
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item text-orange" href="{{ route('tickets.edit',$ticket->id)}}">Edit</a>
                                                <a class="dropdown-item text-blue" href="{{ route('tickets.show',$ticket->id)}}">Show</a>
                                                 <form action="{{ route('tickets.destroy', $ticket->id)}}" method="post">
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
                                    <h3 class="card-title">Ticket Overview</h3>
                                </div>
                                <div class="card-body">
                                    No tickets yet
                                </div>
                            </div>
                    </div>
                    @endif
                    {!! $tickets->appends(\Request::except('page'))->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection



