<?php

namespace App\Http\Controllers;

use App\Models\ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index() {
        $tickets = ticket::orderBy('number')->get();
        return view('index', compact('tickets'));
    }

    public function showPurchaseForm()
    {
        $tickets = Ticket::orderBy('number')->get();
        return view('comprar', compact('tickets'));
    }

    public function purchase(Request $request)
    {
        $request->validate([
            'number' => 'required|integer|exists:tickets,number',
            'vendedor' => 'required|string|max:255',
            'monto_pagado' => 'required|numeric|min:0',
        ]);

        $ticket = Ticket::where('number', $request->number)->first();

        if ($ticket->status === 'vendido') {
            return back()->with('error', 'Ese número ya está vendido.');
        }

        $ticket->status = 'vendido';
        $ticket->vendedor = $request->vendedor;
        $ticket->monto_pagado = $request->monto_pagado;
        $ticket->save();

        return back()->with('success', '¡Ticket registrado con éxito!');
    }
}
