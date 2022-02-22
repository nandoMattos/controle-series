<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Temporada;

class Episodio extends Model
{
    protected $fillable = ['numero'];
    public $timestamps = false;

    public function temporada()
    {
        return $this->belongsTo(Temporada::class);
    }
}
