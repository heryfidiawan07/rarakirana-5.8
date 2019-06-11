<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('etalase_id');
            $table->string('title');
            $table->string('slug')->unique();
            $table->integer('first_price');
            $table->integer('discount')->default(0);
            $table->integer('price');
            $table->integer('weight');
            $table->text('description');
            $table->tinyInteger('type')->default(0);
            $table->tinyInteger('comment')->default(1);
            $table->tinyInteger('status')->default(1);
            $table->tinyInteger('sticky')->default(0);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('etalase_id')->references('id')->on('etalases');
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
}
