<?php

namespace App\Http\Controllers;

use App\Models\Artista;
use Illuminate\Http\Request;

class ArtistaController extends Controller
{

    public function create()
    {
        return view('artistas.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
        ]);

        Artista::create([
            'nome' => $request->nome,
        ]);

        return redirect()->route('albuns.index')->with('sucesso', 'Artista cadastrado com sucesso!');
    }
}