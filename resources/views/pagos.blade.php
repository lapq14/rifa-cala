@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto mt-10 px-4">
    <h2 class="text-3xl font-bold text-center text-red-600 mb-6">💸 Confirmar Pagos Pendientes</h2>

    <form action="{{ route('tickets.confirmarPagos') }}" method="POST">
        @csrf

        <div class="bg-white shadow-md rounded-lg p-6">
            <p class="mb-4 text-gray-700">
                Selecciona los tickets que ya han sido comprados y <span class="font-semibold text-green-600">pagados</span>.
            </p>

            <div class="grid grid-cols-5 sm:grid-cols-10 gap-2 sm:gap-3">
                @forelse ($ticketsSinPagar as $ticket)
                    <label class="relative cursor-pointer">
                        <input type="checkbox" name="tickets[]" value="{{ $ticket->id }}" class="peer hidden">
                        <div class="w-10 h-10 sm:w-12 sm:h-12 flex items-center justify-center rounded-full border 
                            bg-yellow-100 text-yellow-800 font-semibold peer-checked:bg-green-500 
                            peer-checked:text-white peer-checked:border-green-700 transition-all">
                            {{ $ticket->number }}
                        </div>
                    </label>
                @empty
                    <p class="text-gray-500 col-span-full text-center">🎉 ¡Todos los tickets están pagados!</p>
                @endforelse
            </div>

            @if ($ticketsSinPagar->count())
                <div class="mt-6 text-center">
                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded shadow">
                        Confirmar pagos seleccionados
                    </button>
                </div>
            @endif
        </div>
    </form>
</div>
@endsection
