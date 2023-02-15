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
            $table->string('product_name')->nullable();
            $table->string('product_image_path')->nullable();
            $table->double('cost_from_supplier')->nullable();
            $table->double('sale_net_sqm')->nullable();
            $table->double('cut_out')->nullable();
            $table->double('notch')->nullable();
            $table->double('hole')->nullable();
            $table->double('painted')->nullable();
            $table->double('sparkle_finish')->nullable();
            $table->double('metallic_finish')->nullable();
            $table->double('printed')->nullable();
            $table->double('cnc')->nullable();
            $table->double('standblasted')->nullable();
            $table->double('rake')->nullable()->nullable();
            $table->double('ritec')->nullable()->nullable();
            $table->string('type')->nullable()->nullable();
            $table->string('radius_corners')->nullable();
            $table->string('product_note')->nullable();
            $table->string('bevel_edges')->nullable();

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
