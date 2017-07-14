<?php

namespace estoque;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model{
    
    protected $table = 'produtos'; //Podemos emitir esta entrada pois a tabela no banco tem o mesmo nome da classe, porém no plural
    public $timestamps = false;

    protected $fillable = array('nome', 'descricao', 'valor', 'quantidade', 'tamanho', 'categoria_id');

    public function categoria(){
        return $this->belongsTo('estoque\Categoria');
    }

    
    

}
