
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
                    <div class="form-group">
                        <form action="" method="POST" role="search">
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

                    @if(!$tickets->isEmpty() || !$tickets->count() == 0)
                    <div class="col-md-12">
                    <div class="table-responsive-xl">
                        <table class="table table-bordered ">
                            <thead>
                                <tr>

                                    <td align="center">Ticket ID</td>
                                    <td>Ticket Title</td>
                                    <td>Ticket Type</td>
                                    <td>Ticket Priority</td>
                                    <td>Ticket Status</td>
                                    <td>Last Updated</td>

                                    <td align="center">Action</td>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($tickets as $ticket)
                                <tr>
                                    <td align="center"><a href="{{ url('tickets/'. $ticket->id) }}">{{  $ticket->ticket_id }}</a> </td>
                                    <td>
                                       {{ $ticket->ticket_title }}
                                    </td>
                                    <td>
                                        @foreach ($ticket_types as $ticket_type)
                                            @if ($ticket_type->id === $ticket->type_id)
                                                {{ $ticket_type->type_name }}
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>
                                       {{ $ticket->ticket_priority }}
                                    </td>
                                    <td align="center">
                                    @if ($ticket->ticket_status === 'Open')
                                        <span class="tag tag-red">{{ $ticket->ticket_status }}</span>
                                    @else
                                        <span class="tag tag-green">{{ $ticket->ticket_status }}</span>
                                    @endif
                                    </td>
                                    <td>{{ $ticket->updated_at->format('d-m-Y') }}</td>

                                    <td align="center">
                                        <div class="dropdown">
                                            <button type="button" class="btn btn-outline-success dropdown-toggle" data-toggle="dropdown">
                                                <i class="fe fe-calendar mr-2"></i>Actions
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item text-orange" href="{{ route('tickets.edit',$ticket->id)}}">Add comment</a>
                                                <a class="dropdown-item text-blue" href="{{ route('tickets.show',$ticket->id)}}">Show ticket and comments</a>
                                                 <form action="" method="post">
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
                                    <h3 class="card-title">Tickets Overview</h3>
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
</div>
@endsection



