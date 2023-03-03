<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deals', function (Blueprint $table) {
            $table->UUID('id')->primary();
            
            $table->foreignUuid('quote_id')->references('id')->on('quotes')->onDelete('cascade');
            
            $table->foreignUuid('product_id')->references('id')->on('products')->onDelete('cascade');
          
            $table->integer('width')->nullable();
            $table->integer('height')->nullable();
            $table->double('sqm')->nullable();
            $table->double('product_price');
            $table->double('matt_finish')->nullable();
            $table->double('spraying_edges')->nullable();
            $table->double('metallic_paint')->nullable();
            $table->double('wood_stain')->nullable();
            $table->double('gloss_percentage')->nullable();
            $table->double('gloss_100_acrylic_lacquer')->nullable();
            $table->double('polyester')->nullable();
            $table->double('burnished_finish')->nullable();
            $table->double('barrier_coat')->nullable();
            $table->double('edgebanding')->nullable();
            $table->double('micro_bevel')->nullable();
            $table->double('routed_handle_spraying')->nullable();
            $table->double('beaded_door')->nullable();
            $table->integer('quantity');
            $table->double('net_price');
            $table->double('vat');
            $table->integer('trade_discount');
            $table->double('total_gross');
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('deals');
    }
};
