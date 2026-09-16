<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pergunta extends Model
{
    // ... outros atributos e métodos do model

    /**
     * Obtém o usuário autor da pergunta.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
