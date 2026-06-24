@extends('layouts.app')

@section('content')
    <div style="max-w: 600px; margin: 40px auto; padding: 20px; background: #111116; border-radius: 8px; border: 1px solid #222;">
        
        <h2 style="color: #fff; font-size: 1.5em; font-weight: bold; margin-bottom: 20px;">
            Cadastrar Nova Música
        </h2>

        <!-- Formulário enviando os dados para a rota PostController@store -->
        <form action="{{ route('posts.store') }}" method="POST">
            @csrf

            <div style="margin-bottom: 20px;">
                <label for="conteudo" style="display: block; color: #ccc; margin-bottom: 8px; font-size: 0.95em;">
                    Nome da Música / Conteúdo do Post
                </label>
                <input type="text" name="conteudo" id="conteudo" required placeholder="Ex: Linkin Park - In The End"
                       style="width: 100%; padding: 10px 12px; background: #1c1c24; border: 1px solid #333; border-radius: 6px; color: #fff; font-size: 1em;">
            </div>

            <div style="display: flex; gap: 10px; justify-content: flex-end;">
                <a href="{{ route('posts.index') }}" style="color: #aaa; text-decoration: none; padding: 10px 16px; font-size: 0.95em; line-height: 2em;">
                    Cancelar
                </a>
                <button type="submit" style="background: #4f46e5; color: white; border: none; padding: 10px 20px; border-radius: 6px; cursor: pointer; font-weight: bold; font-size: 0.95em;">
                    Salvar no Mural
                </button>
            </div>
        </form>

    </div>
@endsection