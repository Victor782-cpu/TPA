<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePerguntaRequest;
use Illuminate\Http\Request;
use App\Models\Evento;
use App\Models\Pergunta;

class EventoController extends Controller
{
    public function show(Evento $evento)
    {
        $perguntas = $evento->perguntas()
            ->with('user')
            ->latest()
            ->paginate(10);

        return view('eventos.show', compact('evento', 'perguntas'));
    }

    public function index()
    {
        $eventos = Evento::all();
        return view('eventos.index', compact('eventos'));
    }
    /**
     * TICKET #001 (BUG LEGADO DE SEGURANÇA):
     * Salva a pergunta usando a requisição sem validações rigorosas.
     */
    public function storePergunta(StorePerguntaRequest $request, $id)
    {
        $evento = Evento::findOrFail($id);

        Pergunta::create([
            'evento_id' => $evento->id,
            'texto'     => $request->input('texto'),
            'status'    => 'pendente',
        ]);

        return redirect()->route('eventos.show', $evento->id)
            ->with('sucesso', 'Sua pergunta foi enviada com sucesso!');
    }
}

