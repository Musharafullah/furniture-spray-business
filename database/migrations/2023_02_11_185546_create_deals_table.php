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
            $table->integer('quote_id');
            $table->integer('product_id');
            $table->integer('width')->nullable();
            $table->integer('height')->nullable();
            $table->double('sqm')->nullable();
            $table->double('product_price');
            $table->double('cutout')->nullable();
            $table->double('notch')->nullable();
            $table->double('hole')->nullable();
            $table->double('back_select')->nullable();
            $table->double('finish')->nullable();
            $table->double('cnc')->nullable();
            $table->double('sandblasted')->nullable();
            $table->double('ritec')->nullable();
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
