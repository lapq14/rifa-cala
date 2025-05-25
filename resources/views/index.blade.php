@extends('layouts.app')

@section('content')
<h1 class="text-3xl font-bold mb-6 text-center mt-6">🎟️Rifa Calasanz</h1>

<!-- Contenedor que será exportado -->
<div id="export-container" class="relative w-full max-w-3xl mx-auto mt-8 rounded-lg overflow-hidden">
    
    <!-- Contenedor del flyer + tabla en el mismo flujo -->
    <div class="relative">
        <!-- Imagen de fondo -->
        <img src="{{ asset('images/flyer.jpg') }}" alt="Flyer" class="w-full h-auto">

        <!-- Tabla encima, pero dentro del mismo flujo para evitar problemas -->
        <div class="absolute top-[25%] left-1/2 transform -translate-x-1/2 
                    bg-[rgb(251,146,60)] p-3 pb-6 rounded-xl border-4 border-dotted border-white 
                    w-[90%] max-w-[590px] aspect-square overflow-hidden box-content">
            <div class="grid grid-cols-5 sm:grid-cols-10 gap-2 sm:gap-3 w-full h-full">
                @foreach ($tickets as $ticket)
                    <div class="
                        w-10 h-10 sm:w-12 sm:h-12 flex items-center justify-center rounded-full border 
                        font-bold text-[0.8rem] sm:text-lg font-[cursive] text-[#f97316]
                        {{ $ticket->status === 'disponible' ? 'bg-white text-[#1f2937]' : '' }}
                        {{ $ticket->status === 'reservado' ? 'bg-[#fef08a] text-[#78350f] line-through' : '' }}
                        {{ $ticket->status === 'vendido' ? 'bg-[#ea580c] text-transparent' : '' }}
                    ">
                        {{ $ticket->status !== 'vendido' ? $ticket->number : '' }}
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<!-- Botón de exportar -->
<div class="text-center mt-4 mb-6">
    <button onclick="exportarComoImagen()"
        class="bg-[#16a34a] text-white px-4 py-2 rounded hover:bg-[#15803d] transition">
        Exportar como imagen
    </button>
</div>

<!-- html2canvas -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script>
function exportarComoImagen() {
    const container = document.getElementById('export-container');

    html2canvas(container, {
        useCORS: true,
        scale: 2,
        backgroundColor: null,
    }).then(canvas => {
        const link = document.createElement('a');
        link.download = 'rifa_numeros.png';
        link.href = canvas.toDataURL('image/png');
        link.click();
    }).catch(error => {
        console.error("Error al exportar:", error);
    });
}
</script>
@endsection
