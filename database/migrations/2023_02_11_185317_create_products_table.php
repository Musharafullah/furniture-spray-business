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
        Schema::create('products', function (Blueprint $table) {
            $table->UUID('id')->primary();
            $table->string('code')->unique();
            $table->string('type')->nullable();
            $table->string('product_name')->nullable();
            $table->string('product_image_path')->nullable();
            $table->double('cost_from_supplier')->nullable();
            $table->double('sale_net_sqm')->nullable();
            $table->double('price')->nullable();
            $table->double('matt_finish')->nullable();
            //$table->double('min_charges')->nullable();
            $table->double('spraying_edges')->nullable();
            $table->double('metallic_paint')->nullable();
            $table->double('wood_stain')->nullable();
            $table->double('gloss_80')->nullable();
            $table->double('gloss_100_paint')->nullable();
            $table->double('gloss_100_acrylic_lacquer')->nullable();
            $table->double('polyester_or_full_grain')->nullable();
            $table->double('burnished_finish')->nullable();
            $table->double('edgebanding')->nullable();
            $table->double('micro_bevel')->nullable();
            $table->string('product_note')->nullable();
            $table->double('routed_handle_spraying')->nullable();
            $table->double('beaded_door')->nullable();

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
        Schema::dropIfExists('products');
    }
};
