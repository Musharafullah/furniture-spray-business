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
            $table->id();

            $table->unsignedBigInteger('quote_id');
            $table->unsignedBigInteger('product_id');

            // $table->unsignedBigInteger('quote_id');
            $table->foreign('quote_id')->references('id')->on('quotes')->onDelete('cascade')->onUpdate('cascade');

            // $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade')->onUpdate('cascade');


            $table->integer('width')->nullable();
            $table->integer('height')->nullable();
            $table->double('sqm')->nullable();

            $table->double('product_price')->nullable();

            $table->string('matt_finish_option')->nullable();
            $table->string('gloss_percentage_option')->default(0);
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
            $table->string('note')->nullable();

            $table->string('image_status')->default(0);
            // $table->string('total_vat_status')->default(0);
            // $table->string('gross_total_status')->default(0);
            $table->string('net_price_status')->default(0);
            $table->string('collect_status')->default(0);
            $table->string('delivered_status')->default(0);
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
