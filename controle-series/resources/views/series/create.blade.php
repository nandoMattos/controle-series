@extends('layout')

@section('cabecalho')
    Adicionar Série
@endsection

@section('conteudo')
@include ('erros', ['errors' => $errors])

<form method="post">
    @csrf
    <div class="row">
        <div class="col col-8">
            <label for="nome">Nome</label>
            <input type="text" class="form-control" name="nome" id="nome">
        </div>
        <div class="col col-2">
            <label for="qtd_temporadas">Nº Temporadas</label>
            <input type="number" class="form-control" name="qtd_temporadas" id="qtd_temporadas">
        </div>
        <div class="col col-2">
            <label for="qtd_episodios" class="">Ep. por Temp.</label>
            <input type="number" class="form-control" name="qtd_episodios" id="qtd_episodios">
        </div>
    </div>

    <button class="btn btn-dark mt-3">Adicionar</button>
</form>
@endsection