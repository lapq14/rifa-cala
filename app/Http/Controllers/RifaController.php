<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RifaController extends Controller
{
    public function index() {
        $numbers = Number::all(); // o paginar
        return view('rifa.index', compact('numbers'));
    }

    public function admin() {
        $numbers = Number::all();
        return view('rifa.admin', compact('numbers'));
    }

    public function update(Request $request, $id) {
        $number = Number::findOrFail($id);
        $number->status = $request->status;
        $number->buyer_name = $request->buyer_name;
        $number->updated_by = auth()->id();
        $number->save();

        return back()->with('success', 'Número actualizado');
    }

}
