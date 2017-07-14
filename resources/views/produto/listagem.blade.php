@extends('layouts.principal')

@section('conteudo')

  @if(empty($produtos))

    <div class="alert alert-danger">Você não tem nenhum produto cadastrado</div>

  @else

    <h1>Lista de produtos</h1>
    <table class="table table-striped table-bordered table-hover">
      <thead>
        <th>Nome</th>
        <th>Valor</th>
        <th>Descricao</th>
        <th>Categoria</th>
        <th>Quantidade</th>
        <th></th>
        <th></th>
      </thead>
      @foreach($produtos as $produto)
        <tr class="{{ $produto->quantidade <= 1 ? 'danger' : '' }}">
          <td>{{$produto->nome}}</td>
          <td>{{$produto->valor}}</td>
          <td>{{$produto->descricao}}</td>
          <td>{{$produto->categoria->nome}}</td>  
          <td>{{$produto->quantidade}}</td>
          <td><a href="/produtos/mostra/{{$produto->id}}"><span class="glyphicon glyphicon-search"></span></a></td>
          <td><a href="{{action('ProdutoController@remove', $produto->id)}}"><span class="glyphicon glyphicon-trash"></span></a></td>
        </tr>
      @endforeach
    </table>

  @endif

  

  @if(old('nome'))
    <div class="alert alert-success">
        <strong>Sucesso!</strong> 
            O produto {{ old('nome') }} foi adicionado.
    </div>
  @endif

@endsection