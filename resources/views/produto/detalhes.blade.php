@extends('layouts.principal')

@section('conteudo')

  <h1>Detalhe do produto {{$produto->nome}}</h1>
  <ul class="list-unstyled">
    <li><b>Valor</b>: R$ {{$produto->valor}}</li>
    <li><b>Descrição</b>: {{$produto->descricao}}</li>
    <li><b>Quandidade</b>: {{$produto->quantidade}}</li>
    <li><b>Categoria</b>: {{$produto->categoria->nome}}</li>
  </ul>

@endsection
