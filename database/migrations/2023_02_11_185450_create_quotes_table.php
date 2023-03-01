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
        Schema::create('quotes', function (Blueprint $table) {
            $table->UUID('id')->primary();

            $table->unsignedBigInteger('client_id');
            $table->foreign('client_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');


            $table->string('user_id')->nullable();
            $table->string('product_id')->nullable();
            $table->string('width')->nullable();
            $table->string('height')->nullable();
            $table->string('sqm')->nullable();
            $table->string('product_price')->nullable();
            $table->string('matt_finish')->nullable();
            $table->string('spraying_edges')->nullable();
            $table->string('metallic_paint')->nullable();
            $table->string('wood_stain')->nullable();
            $table->string('gloss_80')->nullable();
            $table->string('gloss_100_paint')->nullable();
            $table->string('gloss_100_acrylic_lacquer')->nullable();
            $table->string('polyester')->nullable();
            $table->string('burnished_finish')->nullable();
            $table->string('barrier_coat')->nullable();
            $table->string('edgebanding')->nullable();
            $table->string('micro_bevel')->nullable();
            $table->string('routed_handle_spraying')->nullable();
            $table->string('beaded_door')->nullable();
            $table->string('quantity')->nullable();
            $table->string('net_price')->nullable();
            $table->string('vat')->nullable();
            $table->string('trade_discount')->nullable();
            $table->string('total_gross')->nullable();
            // old columns
            // $table->integer('user_id');
            // $table->double('delivery_distance');
            // $table->string('delivery_option')->nullable();
            // $table->double('delivery_charges')->default(0);
            // $table->string('collected')->nullable();
            // $table->string('delivered')->nullable();
            // $table->string('survey')->nullable();
            // $table->string('status')->nullable();
            // // for paint
            // $table->string('matt_finish')->nullable();
            // $table->string('spraying_edges')->nullable();
            // $table->string('paint_metallic_paint')->nullable();
            // $table->string('wood_stain')->nullable();
            // $table->string('paint_80_Gloss')->nullable();
            // $table->string('paint_100_Gloss')->nullable();
            // $table->string('Gloss_100_acrylic_lacquer')->nullable();
            // $table->string('polyester')->nullable();
            // $table->string('burnished')->nullable();
            // $table->string('barrier_coat')->nullable();
            // $table->string('edgebanding_rate')->nullable();
            // $table->string('paint_micro_bevel')->nullable();
            // $table->string('routed_j')->nullable();
            // $table->string('beaded_door')->nullable();
            // //
            // // for wood
            // $table->string('bevel_edges')->nullable();


            // $table->longText('comment')->nullable();

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
        Schema::dropIfExists('quotes');
    }
};
