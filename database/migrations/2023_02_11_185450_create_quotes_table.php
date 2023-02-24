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

            $table->integer('user_id');
            $table->double('delivery_distance');
            $table->string('delivery_option')->nullable();
            $table->double('delivery_charges')->default(0);
            $table->string('collected')->nullable();
            $table->string('delivered')->nullable();
            $table->string('survey')->nullable();
            $table->string('status')->nullable();
            // for paint
            $table->string('wood_matt_finish')->nullable();
            $table->string('wood_spraying_edges')->nullable();
            $table->string('wood_stain')->nullable();
            $table->string('wood_100_Gloss_acrylic_lacquer')->nullable();
            $table->string('wood_polyester')->nullable();
            $table->string('wood_burnished')->nullable();
            $table->string('wood_dgebanding_rate')->nullable();
            $table->string('wood_routed_j')->nullable();
            $table->string('wood_beaded_door')->nullable();
            //
            // for wood
            $table->string('paint_matt_finish')->nullable();
            $table->string('paint_spraying_edges')->nullable();
            $table->string('paint_metallic_paint')->nullable();
            $table->string('paint_80_Gloss')->nullable();
            $table->string('paint_100_Gloss')->nullable();
            $table->string('paint_100_Gloss2')->nullable();
            $table->string('paint_edgebanding_rate')->nullable();
            $table->string('paint_micro_bevel')->nullable();
            $table->string('paint_routed_j')->nullable();
            $table->string('paint_beaded_door')->nullable();
            $table->string('paint_bevel_edges')->nullable();
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
