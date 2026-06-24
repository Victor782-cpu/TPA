@extends('layouts.app')

@section('content')
    <div style="margin-bottom: 30px;">
        <a href="{{ route('albuns.index') }}" class="btn btn-secondary">← Voltar para Álbuns</a>
    </div>

    <div class="card-form">
        <h2 style="margin-bottom: 5px;">Cadastrar Novo Artista</h2>
        <p style="margin-bottom: 25px;">Insira o nome do artista ou da banda para o catálogo.</p>

        <form action="{{ route('artistas.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="nome">Nome do Artista / Banda *</label>
                <input type="text" id="nome" name="nome" class="form-control" placeholder="Ex: Caetano Veloso, Chico Boarque, Sepultura" value="{{ old('nome') }}" required>
                @error('nome')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-actions">
                <a href="{{ route('albuns.index') }}" class="btn btn-secondary">Cancelar</a>
                <button type="submit" class="btn btn-primary">Salvar Artista</button>
            </div>
        </form>
    </div>
@endsection