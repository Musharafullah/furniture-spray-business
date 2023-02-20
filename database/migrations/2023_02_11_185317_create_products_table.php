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
            $table->string('matt_finish')->nullable();
            $table->double('min_charges')->nullable();
            $table->string('spraying_edges')->nullable();
            $table->string('metallic_paint')->nullable();
            $table->string('wood_stain')->nullable();
            $table->string('gloss_80')->nullable();
            $table->string('gloss_100_paint')->nullable();
            $table->string('gloss_100_acrylic_lacquer')->nullable();
            $table->string('polyester_or_full_grain')->nullable();
            $table->string('burnished_finish')->nullable();
            $table->string('edgebanding')->nullable();
            $table->string('micro_bevel')->nullable();
            $table->string('product_note')->nullable();
            $table->string('routed_handle_spraying')->nullable();
            $table->string('beaded_door')->nullable();

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
