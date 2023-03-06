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
            $table->unsignedBigInteger('user_id');

            $table->foreign('client_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');

            $table->double('collected')->nullable();
            $table->double('delivered')->nullable();
            // status
            $table->string('hide_collect')->default(1)->comment('1: show, 0:hide');
            $table->string('hide_delivered')->default(1)->comment('1: show, 0:hide');
            $table->string('total_net_status')->default(1)->comment('1: show, 0:hide');
            $table->string('total_vat_status')->default(1)->comment('1: show, 0:hide');
            $table->string('gross_total_status')->default(1)->comment('1: show, 0:hide');
            $table->string('net_price_status')->default(1)->comment('1: show, 0:hide');
            $table->string('discount_status')->default(1)->comment('1: show, 0:hide');
            $table->string('product_price_status')->default(1)->comment('1: show, 0:hide');

            // end status

            $table->string('comment')->nullable();
            $table->string('internal_comment')->nullable();
            $table->string('status')->default('draft');


            //
            // $table->string('product_id')->nullable();
            // $table->string('width')->nullable();
            // $table->string('height')->nullable();
            // $table->string('sqm')->nullable();
            // $table->string('product_price')->nullable();
            // $table->string('matt_finish')->nullable();
            // $table->string('spraying_edges')->nullable();
            // $table->string('metallic_paint')->nullable();
            // $table->string('wood_stain')->nullable();
            // $table->string('gloss_80')->nullable();
            // $table->string('gloss_100_paint')->nullable();
            // $table->string('gloss_100_acrylic_lacquer')->nullable();
            // $table->string('polyester')->nullable();
            // $table->string('burnished_finish')->nullable();
            // $table->string('barrier_coat')->nullable();
            // $table->string('edgebanding')->nullable();
            // $table->string('micro_bevel')->nullable();
            // $table->string('routed_handle_spraying')->nullable();
            // $table->string('beaded_door')->nullable();
            // $table->string('quantity')->nullable();
            // $table->string('net_price')->nullable();
            // $table->string('vat')->nullable();
            // $table->string('trade_discount')->nullable();
            // $table->string('total_gross')->nullable();


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
