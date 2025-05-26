<?php

namespace App\Http\Controllers;

use App\Models\ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index() {
        // dd(ticket::where('status','vendido')->where('pago','si')->count());
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

    public function resumenVentas()
    {
        $ticketsVendidos = ticket::where('status', 'vendido');
        $totalVendidos = $ticketsVendidos->count();
        
        $ventasPorPersona = $ticketsVendidos
            ->selectRaw('vendedor, COUNT(*) as cantidad')
            ->groupBy('vendedor')
            // ->orderByDesc('cantidad')
            ->get();
        

        
        $precioPorTicket = 2; // ajusta si es dinámico
        $recaudado = $totalVendidos * $precioPorTicket;

        return view('resumen', compact('ventasPorPersona', 'totalVendidos', 'recaudado'));
    }

    public function pagos()
    {
        $ticketsSinPagar = Ticket::where('pago', 'no')->whereNotNull('vendedor')->orderBy('number')->get();
        return view('pagos', compact('ticketsSinPagar'));
    }

    public function confirmarPagos(Request $request)
    {
        $ids = $request->input('tickets', []);

        Ticket::whereIn('id', $ids)->update(['pago' => 'si']);

        return redirect()->back()->with('success', 'Pagos confirmados correctamente.');
    }


}
