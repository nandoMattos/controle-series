<?php

namespace Tests\Feature;

use App\Models\Serie;
use App\Services\CriadorDeSerie;
use App\Services\RemovedorSerie;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RemovedorDeSerieTest extends TestCase
{
    use RefreshDatabase;

    private Serie $serie;

    public function setUp():void
    {
        parent::setUp();
        $criadorDeSerie = new CriadorDeSerie();
        $this->serie = $criadorDeSerie->criarSerie('Nome', 1, 1);

    }

    public function testRemoverSerie()
    {
        $this->assertDatabaseHas('series', ['id' => $this->serie->id]);
        $removedorSerie = new RemovedorSerie();
        $nomeSerie = $removedorSerie->removerSerie($this->serie->id);
        $this->assertIsString($nomeSerie);
        $this->assertEquals('Nome', $this->serie->nome);

        $this->assertDatabaseMissing('series', ['id' => $this->serie->id]);

    }
}
