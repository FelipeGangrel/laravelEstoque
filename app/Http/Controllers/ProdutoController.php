<?php

namespace estoque\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Request;
use estoque\Http\Requests\ProdutoRequest;
use estoque\Produto;
use estoque\Categoria;


class ProdutoController extends Controller {

    public function __construct()
    {   
        // $this->middleware('auth'); // protegendo tudo
        $this->middleware('auth', ['only'=>['lista', 'adiciona', 'remove']]); // protegendo apenas as rotas do array
    }

    public function lista() {
        $produtos = Produto::all();
        return view('produto.listagem', compact('produtos'));
    }

    public function mostra($id) {
        $produto = Produto::find($id);
        if(empty($produto)){
            return "Esse produto não existe";
        }else{
            return view('produto.detalhes', compact('produto'));
        }
    }

    public function novo() {
        return view('produto.formulario')->with('categorias', Categoria::all());
    }

    public function adiciona(ProdutoRequest $request) {
        Produto::create($request->all());
        return redirect()
            ->action('ProdutoController@lista')
            ->withInput(Request::only('nome'));
    }

    public function listaJson(){
        $produtos = Produto::all();
        return $produtos;
    }

    public function remove($id){
        $produto = Produto::find($id);
        $produto->delete();
        return redirect()
            ->action('ProdutoController@lista');
        }
}
