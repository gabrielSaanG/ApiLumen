<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_item', function (Blueprint $table) {
            $table->id('sales_item_id');
            $table->date('sales_item_date');
            $table->integer('sale_id');
            $table->integer('product_id');
            $table->integer('quantity');
            $table->decimal('unit_price', 8,2);
            $table->decimal('total_price', 8,2)->storedAs('unit_price * quantity');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales_item');
    }
}
