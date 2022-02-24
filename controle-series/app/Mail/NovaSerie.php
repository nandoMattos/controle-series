<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NovaSerie extends Mailable
{
    use Queueable, SerializesModels;

    public string $nome;    
    public int $qtdTemporadas;    
    public int $qtdEpisodios;    

    public function __construct(string  $nome, int $qtdTemporadas, int $qtdEpisodios)
    {
        $this->nome = $nome;
        $this->qtdTemporadas = $qtdTemporadas;
        $this->qtdEpisodios = $qtdEpisodios;
    }

    public function build()
    {
        return $this->markdown('mail.serie.nova-serie');
    }
}
