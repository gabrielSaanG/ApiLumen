<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifySalesItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sales_item', function (Blueprint $table) {
            $table->bigInteger('sale_id')->change()->unsigned()->index();
            $table->bigInteger('product_id')->change()->unsigned()->index();

            $table->foreign('sale_id')->references('sale_id')->on('sales');
            $table->foreign('product_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sales_item', function (Blueprint $table) {

        });
    }
}
