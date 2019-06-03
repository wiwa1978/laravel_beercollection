<?php

namespace App\Http\Controllers;

use App\Ticket;
use App\TicketType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tickets = Ticket::where('user_id', Auth::user()->id)->paginate(10);
        $ticket_types = TicketType::all();

        return view('backend.tickets.index', compact('tickets', 'ticket_types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ticket_types = TicketType::all();

        return view('backend.tickets.create', compact('ticket_types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return $request;

        $this->validate($request, [
            'ticket_title'          =>      'required',
            'ticket_type'           =>      'required',
            'ticket_priority'       =>      'required',
            'ticket_description'    =>      'required'
        ]);

        $ticket = new Ticket([
            'ticket_title'          =>      $request->input('ticket_title'),
            'user_id'               =>      Auth::user()->id,
            'ticket_id'             =>      strtoupper(str_random(10)),
            'type_id'               =>      $request->input('ticket_type'),
            'ticket_priority'       =>      $request->input('ticket_priority'),
            'ticket_description'    =>      $request->input('ticket_description'),
            'ticket_status'         =>      "Open",
        ]);

        $ticket->save();

        //$mailer->sendTicketInformation(Auth::user(), $ticket);

        return redirect()->back()->with("success", "A ticket with ID '$ticket->ticket_id' has been opened.");
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {
        //dd($ticket);
        //$ticket_types = TicketType::all();
        $ticket_type = TicketType::where('id', $ticket->type_id)->firstOrFail();



        return view('backend.tickets.show', compact('ticket', 'ticket_type'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function edit(Ticket $ticket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ticket $ticket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        //
    }
}
