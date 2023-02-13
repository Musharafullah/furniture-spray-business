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
        Schema::create('clients', function (Blueprint $table) {
            $table->UUID('id')->primary();
            $table->string('name');
            $table->string('phone')->nullable();
            $table->string('postal_code');
            $table->string('address')->nullable();
            $table->double('latitude');
            $table->double('longitude');
            $table->double('distance');
            $table->string('password');
            $table->double('trade_discount');
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
        Schema::dropIfExists('clients');
    }
};
