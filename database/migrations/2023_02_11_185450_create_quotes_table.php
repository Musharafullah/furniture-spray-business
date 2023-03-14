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
            $table->id();

            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('user_id');

            $table->foreign('client_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');

            $table->double('collected')->nullable();
            $table->double('delivered')->nullable();
            $table->longText('comment')->nullable();
            $table->longText('internal_comment')->nullable();
            // status
            $table->string('hide_collect')->default(1)->comment('1: show, 0:hide');
            $table->string('hide_delivered')->default(0)->comment('1: show, 0:hide');
            $table->string('total_net_status')->default(1)->comment('1: show, 0:hide');
            $table->string('total_vat_status')->default(1)->comment('1: show, 0:hide');
            $table->string('gross_total_status')->default(1)->comment('1: show, 0:hide');
            $table->string('net_price_status')->default(1)->comment('1: show, 0:hide');
            $table->string('discount_status')->default(1)->comment('1: show, 0:hide');
            $table->string('product_price_status')->default(1)->comment('1: show, 0:hide');
            $table->string('status')->default('draft');

            // end status

            // $table->string('delivery_option')->default('-');
            // $table->double('collected')->nullable();
            // $table->double('delivered')->nullable();
            // $table->longText('comment')->nullable();
            // $table->longText('internal_comment')->nullable();
            // $table->integer('hide_collect')->default(1);
            // $table->integer('hide_delivered')->default(1);
            // $table->integer('total_net_status')->default(1);
            // $table->integer('total_vat_status')->default(1);
            // $table->integer('gross_total_status')->default(1);
            // $table->integer('net_price_status')->default(1);
            // $table->integer('discount_status')->default(1);
            // $table->integer('product_price_status')->default(1);
            // $table->string('hidden_price')->default('Option_3(hide_all_price_column_and_discount_including_gross_total,vat,total net)');
            // $table->string('billing_postal_code')->nullable();
            // $table->string('status')->default('draft');


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
