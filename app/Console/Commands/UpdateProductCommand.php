<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class UpdateProductCommand extends Command
{

    protected $signature = 'product:update-product {id} {product_name} {product_description} {buy_price} {sell_price}';


    protected $description = 'Atualizar informações de um produto';


    public function __construct()
    {
        parent::__construct();
    }


    public function handle()
    {
        $id = $this->argument('id');
        $product_name = $this->argument('product_name');
        $product_description = $this->argument('product_description');
        $buy_price = $this->argument('buy_price');
        $sell_price = $this->argument('sell_price');

        $produto = Produto::find($id);
        if  ($produto) {
            $produto->product_name = $product_name;
            $produto->product_description = $product_description;
            $produto->buy_price = $buy_price;
            $produto->sell_price = $sell_price;
            $produto->save();

        } else{
            $this->error("Produto não encontrado.");
        }
    }
}
