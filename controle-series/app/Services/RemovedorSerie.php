<?php

namespace App\Services;

use App\Models\{Episodio, Serie, Temporada};
use Illuminate\Support\Facades\DB;

class RemovedorSerie
{
    public function removerSerie(int $serieId): string
    {
        $nomeSerie = '';
        DB::transaction(function () use ($serieId, &$nomeSerie) {
            $serie = Serie::find($serieId);
            $nomeSerie = $serie->nome;
            
            $this->removerTemporadas($serie);
            $serie->delete();
        });
        
        return $nomeSerie;
    }

    private function removerTemporadas(Serie $serie): void
    {
        $serie->temporadas->each(function (Temporada $temporada) {
           $this->removerEspisodios($temporada);
           $temporada->delete();
        });
    }

    private function removerEspisodios(Temporada $temporada): void
    {
        $temporada->episodios()->each(function (Episodio $episodio) {
            $episodio->delete();
        });
    }
}