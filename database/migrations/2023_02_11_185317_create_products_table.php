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
            $table->id();
            $table->string('code');
            $table->string('type')->nullable();
            $table->string('product_name')->nullable();
            $table->string('product_image_path')->nullable();
            $table->double('cost_from_supplier')->nullable()->default(0);
            $table->double('sale_net_sqm')->nullable();
            $table->double('min_sqm')->default(0.30);
            $table->double('matt_finish')->nullable()->default(0);
            //$table->double('min_charges')->nullable();
            $table->double('spraying_edges')->nullable()->default(0);
            $table->double('metallic_paint')->nullable()->default(0);
            $table->double('wood_stain')->nullable()->default(0);
            $table->double('gloss_80')->nullable()->default(0);
            $table->double('gloss_100_paint')->nullable()->default(0);
            $table->double('gloss_100_acrylic_lacquer')->nullable()->default(0);
            $table->double('polyester_or_full_grain')->nullable()->default(0);
            $table->double('burnished_finish')->nullable()->default(0);
            $table->double('edgebanding')->nullable()->default(0);
            $table->double('micro_bevel')->nullable()->default(0);
            $table->string('product_note')->nullable();
            $table->double('routed_handle_spraying')->nullable()->default(0);
            $table->double('beaded_door')->nullable()->default(0);
            $table->double('barrier_coat')->nullable()->default(0);

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
