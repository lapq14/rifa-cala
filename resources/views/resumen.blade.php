@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto mt-10 px-4">
    <h2 class="text-3xl font-extrabold text-center text-orange-600 mb-8">
        📊 Resumen de Ventas de la Rifa
    </h2>

    <!-- Resumen general -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-10">
        <div class="bg-white shadow-md rounded-lg p-6 flex items-center justify-between border-l-4 border-green-500">
            <div>
                <p class="text-gray-500 text-sm uppercase">Tickets Vendidos</p>
                <p class="text-2xl font-bold text-green-600">{{ $totalVendidos }}</p>
            </div>
            <div class="text-green-500 text-3xl">🎫</div>
        </div>

        <div class="bg-white shadow-md rounded-lg p-6 flex items-center justify-between border-l-4 border-indigo-500">
            <div>
                <p class="text-gray-500 text-sm uppercase">Monto Recaudado</p>
                <p class="text-2xl font-bold text-indigo-600">${{ number_format($recaudado, 2) }}</p>
            </div>
            <div class="text-indigo-500 text-3xl">💰</div>
        </div>

        <div class="bg-white shadow-md rounded-lg p-6 flex items-center justify-between border-l-4 border-yellow-500">
            <div>
                <p class="text-gray-500 text-sm uppercase">Personas que colaboraron</p>
                <p class="text-2xl font-bold text-yellow-600">{{ $ventasPorPersona->count() }}</p>
            </div>
            <div class="text-yellow-500 text-3xl">🧍‍♂️</div>
        </div>
    </div>

    <!-- Tabla de ventas -->
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200 text-sm">
            <thead class="bg-orange-100">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-bold text-orange-600 uppercase tracking-wider">
                        Nombre
                    </th>
                    <th class="px-6 py-3 text-center text-xs font-bold text-orange-600 uppercase tracking-wider">
                        Tickets vendidos
                    </th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse ($ventasPorPersona as $venta)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 font-medium text-gray-700">
                            {{ $venta->vendedor }}
                        </td>
                        <td class="px-6 py-4 text-center font-semibold text-gray-800">
                            {{ $venta->cantidad }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" class="text-center py-6 text-gray-400">No hay tickets vendidos aún.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
