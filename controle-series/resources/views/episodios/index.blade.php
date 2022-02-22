@extends('layout')


@section('cabecalho')
    Lista de Episódios
@endsection

@section('conteudo')
    <h1 style="text-align: center">Marque os Episódios assistidos</h1>
    @include('mensagem', ['mensagem' => $mensagem])
    <div class="d-flex justify-content-between align-items-center">
        <a href="/series/{{$serieId}}/temporadas" class="btn btn-dark mb-3">Voltar</a>
        <form action="/temporadas/{{ $temporadaId }}/episodios/assistir" method="post">
            @csrf
            
            <button class="btn btn-dark mb-3">Salvar</button>
    </div>
        <ul class="list-group">
            @foreach ($episodios as $episodio)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Episódio {{ $episodio->numero }}
                    <input type="checkbox"
                    name="episodios[]" 
                    value="{{ $episodio->id }}"
                    {{ $episodio->assistido ? 'checked' : '' }}>
                </li>
            @endforeach
        </ul>
    </form>
@endsection