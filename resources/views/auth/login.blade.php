@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100 px-4">
    <div class="w-full max-w-md bg-white rounded shadow p-6">
        <h2 class="text-2xl font-bold mb-6 text-center">Iniciar Sesión</h2>

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">Correo</label>
                <input type="email" name="email" required autofocus
                    class="w-full border border-gray-300 rounded p-2" value="{{ old('email') }}">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">Contraseña</label>
                <input type="password" name="password" required
                    class="w-full border border-gray-300 rounded p-2">
            </div>

            <button type="submit"
                class="w-full bg-orange-500 text-white py-2 rounded hover:bg-orange-600 transition">
                Ingresar
            </button>
        </form>
    </div>
</div>
@endsection
