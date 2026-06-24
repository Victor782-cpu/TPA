<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artista extends Model
{
    use HasFactory;

    protected $table = 'artistas'; 
    protected $fillable = ['nome'];

    public function albums()
    {
        return $this->hasMany(Album::class, 'artista_id');
    }
}