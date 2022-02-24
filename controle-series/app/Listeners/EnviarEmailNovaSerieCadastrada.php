<?php

namespace App\Listeners;

use App\Events\EventoNovaSerie;
use App\Mail\NovaSerie;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class EnviarEmailNovaSerieCadastrada implements ShouldQueue
{
    public function __construct()
    {
        //  
    }

    public function handle(EventoNovaSerie $event)
    {
        $nomeSerie = $event->nomeSerie;
        $qtdTemporadas = $event->qtdTemporadas;
        $qtdEpisodios = $event->qtdEpisodios;

        $useres = User::all();
        foreach ($useres as $indice => $user) {
            $multiplicador = $indice + 1;
            $email = new NovaSerie(
                $nomeSerie,
                $qtdTemporadas, 
                $qtdEpisodios
            );
        $email->subject = 'Nova série adicionada';
        $quando = now()->addSecond($multiplicador * 10);
        Mail::to($user)->later($quando, $email);
        }
    }
}
