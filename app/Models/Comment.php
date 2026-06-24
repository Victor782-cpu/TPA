<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['content', 'user_id', 'post_id'];

    // Atividade: Relacionamento com o Usuário que criou o comentário
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Atividade: Relacionamento com o Post ao qual o comentário pertence
    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id');
    }
}