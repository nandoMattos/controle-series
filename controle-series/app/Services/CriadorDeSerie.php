<?php

namespace App\Services;

use App\Models\Serie;
use App\Models\Temporada;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;

class CriadorDeSerie
{
    public function criarSerie(
        string $nomeSerie, 
        int $qtdTemporadas, 
        int $qtdEpisodios,
        ?string $capa
    ):Serie
    {
        DB::beginTransaction();
        $serie = Serie::create(['nome' => $nomeSerie, 'capa' => $capa]);
        $this->criaTemporadas($qtdTemporadas, $qtdEpisodios, $serie);
        DB::commit();

        return $serie;

        /*  Assim fica muito dificil de ler
        $serie = null;
        DB::transaction(function () use ($nomeSerie, $qtdTemporadas, $qtdEpisodios, &$serie) {
            $serie = Serie::create(['nome' => $nomeSerie]);
            $this->criaTemporadas($qtdTemporadas, $qtdEpisodios, $serie);
        });

        return $serie;
        */
    }

    private function criaTemporadas(int $qtdTemporadas, int $qtdEpisodios, Serie $serie):void
    {
        for ($i = 1; $i <= $qtdTemporadas; $i++) {
            $temporada = $serie->temporadas()->create(['numero' => $i]);

            $this->criaEpisodios($qtdEpisodios, $temporada);
        }
    }

    private function criaEpisodios(int $qtdEpisodios, Temporada $temporada): void
    {
        for ($j = 1; $j <= $qtdEpisodios; $j++) {
            $temporada->episodios()->create(['numero' => $j]);
        }
    }
}