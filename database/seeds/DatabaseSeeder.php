<?php

use Illuminate\Database\Seeder;
use App\Categoria;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(CategoriasTableSeeder::class);
    }
}

class CategoriasTableSeeder extends Seeder 
{
    public function run(){
        Categoria::create(['nome'=>'eletrônicos']);
        Categoria::create(['nome'=>'eletrodomésticos']);
        Categoria::create(['nome'=>'brinquedos']);
    }
}
