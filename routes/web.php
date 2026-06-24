<?php

use App\Http\Controllers\AlbumController;
use App\Http\Controllers\MusicaController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ArtistaController;

// Redireciona a página raiz para a listagem de álbuns
Route::get('/', function () {
    return redirect()->route('albuns.index');
});

// Rotas do tipo Resource para Álbuns e Músicas
Route::resource('albuns', AlbumController::class);
Route::resource('musicas', MusicaController::class);

// --- ROTAS DO SISTEMA DE POSTS (Plano de Aula: O Crachá e a Chave) ---
// Estado Inicial: Vulnerável (Sem middleware 'auth' ativo). Visitantes podem acessar e manipular posts.

// SPRINT 1: Para proteger todas as rotas do CRUD de posts, os alunos devem comentar a linha acima 
// e descomentar a linha abaixo (ativando o middleware 'auth'):
// Route::resource('posts', PostController::class)->middleware('auth');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('posts', PostController::class);
});

Route::middleware(['auth'])->group(function () {
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
    Route::get('/artistas/create', [ArtistaController::class, 'create'])->name('artistas.create');
    Route::post('/artistas', [ArtistaController::class, 'store'])->name('artistas.store');
});
require __DIR__.'/auth.php';
