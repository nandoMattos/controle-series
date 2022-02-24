<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class EventoNovaSerie
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public string $nomeSerie;
    public int $qtdTemporadas;
    public int $qtdEpisodios;

    public function __construct(string $nomeSerie, int $qtdTemporadas, int $qtdEpisodios)
    {
        $this->nomeSerie = $nomeSerie;
        $this->qtdTemporadas = $qtdTemporadas;
        $this->qtdEpisodios = $qtdEpisodios;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
