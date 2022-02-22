@extends('layout')

@section('cabecalho')
    Registrar
@endsection

@section('conteudo')
    
    <form method="post">
        @csrf
        <div class="form-group">
            <label for="name">Nome</label>
            <input type="text" name="name" id="name" required class="form-control">
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" name="email" id="email" required class="form-control">
        </div>

        <div class="form-group">
            <label for="password">Senha</label>
            <input type="password" name="password" id="password" required class="form-control">
        </div>

        <button class="btn btn-dark">Registrar</button>
        
    </form>

@endsection