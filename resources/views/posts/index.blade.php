@extends('layouts.app')

@section('content')
<div style="max-width: 850px; margin: 40px auto; padding: 0 20px;">

    <div style="background: #111116; border: 1px solid #222; padding: 25px; border-radius: 8px; margin-bottom: 40px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);">
        <h3 style="color: #fff; margin-top: 0; margin-bottom: 15px; font-weight: bold; font-size: 1.25em;">
            Compartilhe algo no Mural
        </h3>
        
        <form action="{{ route('posts.store') }}" method="POST">
            @csrf
            <div style="margin-bottom: 15px;">
                <input type="text" name="conteudo" required placeholder="No que você está pensando ou qual música quer indicar?"
                       style="width: 100%; padding: 14px; background: #1c1c24; border: 1px solid #333; border-radius: 6px; color: #fff; font-size: 1em; outline: none;">
            </div>
            <div style="text-align: right;">
                <button type="submit" style="background: #4f46e5; color: white; border: none; padding: 12px 24px; border-radius: 6px; cursor: pointer; font-weight: bold; font-size: 0.95em;">
                    Postar no Mural
                </button>
            </div>
        </form>
    </div>


    @forelse($posts as $post)
        <div style="background: #111116; border: 1px solid #222; padding: 25px; border-radius: 8px; margin-bottom: 25px;">
            
            <h2 style="color: #fff; font-size: 1.5em; font-weight: bold; margin-top: 0; margin-bottom: 8px;">
                {{ $post->conteudo }}
            </h2>
            <p style="color: #aaa; font-size: 0.9em; margin-bottom: 20px;">
                <strong>Autor:</strong> {{ $post->user->name }}
            </p>

            <hr style="border: 0; border-top: 1px solid #222; margin-bottom: 20px;">


            <h3 style="color: #fff; font-size: 1.1em; font-weight: bold; margin-bottom: 15px;">Comentários</h3>


            <form action="{{ route('comments.store', $post->id) }}" method="POST" style="display: flex; gap: 10px; margin-bottom: 20px;">
                @csrf
                <input type="text" name="content" required placeholder="Escreva um comentário..." 
                       style="flex: 1; padding: 10px 14px; background: #1c1c24; border: 1px solid #333; border-radius: 6px; color: #fff; font-size: 0.95em;">
                <button type="submit" style="background: #4f46e5; color: white; border: none; padding: 10px 20px; border-radius: 6px; cursor: pointer; font-weight: bold; font-size: 0.95em;">
                    Comentar
                </button>
            </form>


            <div style="display: flex; flex-direction: column; gap: 12px;">
                @foreach($post->comentarios as $comentario)
                    <div style="background: #1c1c24; border-left: 3px solid #4f46e5; padding: 12px 16px; border-radius: 4px; display: flex; justify-content: space-between; align-items: center;">
                        <div>
                            <strong style="color: #fff; font-size: 0.95em; display: block; margin-bottom: 4px;">
                                {{ $comentario->user->name }}:
                            </strong>
                            <span style="color: #ccc; font-size: 0.95em;">
                                {{ $comentario->content }}
                            </span>
                        </div>

            <!-- Botão de Apagar (Apenas aparece se o comentário for do usuário logado) -->
            @if(auth()->id() === $comentario->user_id)
                <form action="{{ route('comments.destroy', $comentario->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja apagar este comentário?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" style="background: transparent; color: #ef4444; border: none; cursor: pointer; font-size: 0.9em; font-weight: bold; padding: 5px 10px; border-radius: 4px; transition: 0.2s;" onmouseover="this.style.background='#2d1f22'" onmouseout="this.style.background='transparent'">
                        Excluir
                    </button>
                </form>
            @endif
        </div>
    @endforeach
</div>
    @empty

        <div style="background: #111116; border: 1px solid #222; padding: 40px 20px; border-radius: 8px; text-align: center; color: #aaa;">
            Nenhuma música encontrada no mural. Digite na caixa acima para criar a primeira!
        </div>
    @endforelse

</div>
@endsection