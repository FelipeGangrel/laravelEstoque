<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use estoque\Http\Requests\ProdutoRequest;

class ProdutoTest extends TestCase
{
    private $rules;
    private $validator;

    public function setUp(){

        parent::setUp();

        $this->rules = (new ProdutoRequest())->rules();
        $this->validator = $this->app['validator'];
    }

    /**
     * A basic test example.
     * @return void
     */
    public function test_DeveSerUmProdutoValido()
    {
        // Deve ter 4 regras de validação
        $this->assertEquals(4, count($this->rules));

        $data = [
            'nome'=> 'abc',
            'descricao'=> 'Produto Descrição',
            'valor'=> '1200.00',
            'quantidade'=> 2,
            'tamanho'=> 'teste',
            'categoria_id'=> 1
        ];

        $data1 = [
            'valor'=> '12'
        ];
        $rules1 = [
            'valor'=> $this->rules['valor']
        ];

        $v = $this->validator->make($data, $this->rules);
        $this->assertTrue($v->passes());

        $v = $this->validator->make($data1, $rules1);
        $this->assertTrue($v->passes());

    }
}
