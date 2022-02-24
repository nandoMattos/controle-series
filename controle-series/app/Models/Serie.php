<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Temporada;

class Serie extends Model
{
    // protected $table = 'series';    Não precisa pq o nome ta certo
    public $timestamps = false;
    protected $fillable = ['nome', 'capa'];

    public function temporadas()
    {
        return $this->hasMany(Temporada::class);
    }
}