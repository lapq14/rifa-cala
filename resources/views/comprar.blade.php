@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-8 px-4">
    <h2 class="text-2xl font-bold text-center mb-4">Comprar Número de Rifa</h2>

    @if(session('success'))
        <div class="bg-green-200 text-green-800 p-3 rounded mb-4">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="bg-red-200 text-red-800 p-3 rounded mb-4">{{ session('error') }}</div>
    @endif

    <form method="POST" action="{{ route('tickets.purchase') }}" class="mb-8">
        @csrf
        <div class="grid grid-cols-1 sm:grid-cols-4 gap-4 mb-4">
            <input type="number" name="number" placeholder="Número a comprar" required
                class="border border-gray-300 p-2 rounded text-center" min="1" />

            <input type="text" name="vendedor" placeholder="Vendedor" required
                class="border border-gray-300 p-2 rounded text-center" />

            <input type="number" step="0.01" name="monto_pagado" placeholder="Monto pagado" required
                class="border border-gray-300 p-2 rounded text-center" min="0" />

            <button type="submit"
                class="bg-orange-500 text-white px-4 py-2 rounded hover:bg-orange-600 transition">
                Registrar
            </button>
        </div>

        @error('number')
            <div class="text-red-500 mt-1 text-sm">{{ $message }}</div>
        @enderror
        @error('vendedor')
            <div class="text-red-500 mt-1 text-sm">{{ $message }}</div>
        @enderror
        @error('monto_pagado')
            <div class="text-red-500 mt-1 text-sm">{{ $message }}</div>
        @enderror
    </form>


    {{-- Tabla de referencia --}}
    <div class="bg-orange-400 p-4 rounded-xl border-4 border-dotted border-white">
        <div class="grid grid-cols-5 sm:grid-cols-10 gap-4 justify-center">
            @foreach ($tickets as $ticket)
                <div class="
                    w-14 h-14 flex items-center justify-center rounded-full border text-orange-500 font-bold text-xl md:text-2xl font-[cursive]
                    {{ $ticket->status === 'disponible' ? 'bg-white text-gray-800' : '' }}
                    {{ $ticket->status === 'reservado' ? 'bg-yellow-200 text-yellow-900 line-through' : '' }}
                    {{ $ticket->status === 'vendido' ? 'bg-orange-600 text-transparent' : '' }}
                ">
                    {{ $ticket->status !== 'vendido' ? $ticket->number : '' }}
                </div>
            @endforeach
        </div>
    </div>
</div>

<form action="{{route('logout')}}" method="post">@csrf<button type="submit">Salir</button></form>
@endsection
