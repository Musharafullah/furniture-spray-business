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
            $table->integer('client_id');
            $table->integer('user_id');
            $table->double('delivery_distance');
            $table->string('delivery_option')->nullable();
            $table->double('delivery_charges')->default(0);
            $table->string('collected')->nullable();
            $table->string('delivered')->nullable();
            $table->string('survey')->nullable();
            $table->longText('comment')->nullable();

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
