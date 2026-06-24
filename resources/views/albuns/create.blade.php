@extends('layouts.app')

@section('content')
    <div style="margin-bottom: 30px;">
        <a href="{{ route('albuns.index') }}" class="btn btn-secondary">← Voltar para Álbuns</a>
    </div>

    <div class="card-form">
        <h2 style="margin-bottom: 5px;">Cadastrar Novo Álbum</h2>
        <p style="margin-bottom: 25px;">Insira os dados do disco abaixo.</p>

        <form action="{{ route('albuns.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="titulo">Título do Álbum *</label>
                <input type="text" id="titulo" name="titulo" class="form-control" placeholder="Ex: Dark Side of the Moon" value="{{ old('titulo') }}" required>
                {{-- Exibe a mensagem de erro caso a validação do campo falhar no Controller --}}
                @error('titulo')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="artista_id">Artista / Banda *</label>
                <select id="artista_id" name="artista_id" class="form-control" required style="cursor: pointer;">
                    <option value="" disabled {{ old('artista_id') ? '' : 'selected' }}>Selecione um artista...</option>
                    @foreach($artistas as $artista)
                        <option value="{{ $artista->id }}" {{ old('artista_id') == $artista->id ? 'selected' : '' }}>
                            {{ $artista->nome }}
                        </option>
                    @endforeach
                </select>
                @error('artista_id')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="ano">Ano de Lançamento *</label>
                <input type="number" id="ano" name="ano" class="form-control" placeholder="Ex: 1973" value="{{ old('ano') }}" required>
                @error('ano')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="capa_url">URL da Imagem da Capa (Opcional)</label>
                <input type="url" id="capa_url" name="capa_url" class="form-control" placeholder="Ex: https://link-da-imagem.com/capa.jpg" value="{{ old('capa_url') }}">
                @error('capa_url')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-actions">
                <a href="{{ route('albuns.index') }}" class="btn btn-secondary">Cancelar</a>
                <button type="submit" class="btn btn-primary">Salvar Álbum</button>
            </div>
        </form>
    </div>
@endsection