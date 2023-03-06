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

            // $table->unsignedBigInteger('quote_id');
            $table->foreignUuid('quote_id')->references('id')->on('quotes')->onDelete('cascade');

            // $table->unsignedBigInteger('product_id');
            $table->foreignUuid('product_id')->references('id')->on('products')->onDelete('cascade');

            $table->integer('width')->nullable();
            $table->integer('height')->nullable();
            $table->double('sqm')->nullable();
            $table->double('product_price')->nullable();
            $table->double('matt_finish_option')->nullable();
            $table->double('matt_finish')->nullable();
            $table->double('spraying_edges')->nullable();
            $table->double('metallic_paint')->nullable();
            $table->double('wood_stain')->nullable();
            $table->double('gloss_percentage')->nullable();
            $table->double('gloss_100_acrylic_lacquer')->nullable();
            $table->double('polyester')->nullable();
            $table->integer('burnished_finish')->nullable();
            $table->double('barrier_coat')->nullable();
            $table->double('edgebanding')->nullable();
            $table->integer('micro_bevel')->nullable();
            $table->double('routed_handle_spraying')->nullable();
            $table->double('beaded_door')->nullable();
            $table->double('quantity')->nullable();
            $table->double('net_price')->nullable();
            $table->double('vat')->nullable();
            $table->double('trade_discount')->nullable();
            $table->double('total_gross')->nullable();

            $table->string('status')->nullable();
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
