<?php

namespace App\Http\Controllers;

use App\Events\EventoNovaSerie;
use App\Http\Requests\SeriesFormRequest;
use App\Models\Serie;
use App\Services\CriadorDeSerie;
use App\Services\RemovedorSerie;
use Illuminate\Http\Request;

class SeriesController extends Controller
{
    public function index(Request $request) {
        $series = Serie::query()
            ->orderBy('nome')
            ->get();
        $mensagem = $request->session()->get('mensagem');

        return view('series.index', compact('series', 'mensagem'));
    }

    public function create()
    {
        return view('series.create');
    }

    public function store(SeriesFormRequest $request, CriadorDeSerie $criadorSeries)
    {
        dd($request->file('capa')->store('serie'));
        $serie = $criadorSeries->criarSerie(
            $request->nome,
            $request->qtd_temporadas,
            $request->qtd_episodios,
            $request->capa
        );

        $eventoNovaSerie = new EventoNovaSerie(
            $request->nome,
            $request->qtd_temporadas,
            $request->qtd_episodios
        );
        
        event($eventoNovaSerie);

        $request->session()
            ->flash(
                'mensagem',
                "Série {$serie->nome} e temporadas criadas com sucesso"
            );

        return redirect('/series');
    }

    public function destroy(Request $request, RemovedorSerie $removedorSerie)
    {
        $nomeSerie = $removedorSerie->removerSerie($request->id);
        $request->session()
            ->flash(
                'mensagem',
                "Série $nomeSerie removida com sucesso"
        );
            
        return redirect('/series');
    }

    public function editaNome(int $id, Request $request)   
    {
        $novoNome = $request->nome;
        $serie = Serie::find($id);     // Se eu colocar o mesmo nome da variável na rota, nao preciso fazer $request->id
        $serie->nome = $novoNome;
        $serie->save();
    }
}
