<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('no_order');
            $table->unsignedBigInteger('address_id');
            $table->string('resi_kurir')->nullable();
            $table->integer('total_price');
            $table->string('note');
            $table->string('kurir');
            $table->string('services');
            $table->integer('ongkir');
            $table->unsignedBigInteger('user_id');
            $table->tinyInteger('status')->default(0);
            $table->string('slug_token');
            $table->string('private_token');
            $table->timestamps();

            $table->foreign('address_id')->references('id')->on('addresses')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
