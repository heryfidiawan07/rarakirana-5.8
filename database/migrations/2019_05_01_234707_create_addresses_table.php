<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('penerima');
            $table->string('address');
            $table->integer('prov_id');
            $table->string('provinsi');
            $table->integer('kab_id');
            $table->string('kabupaten');
            $table->integer('kec_id')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('postal_code');
            $table->string('phone');
            $table->tinyInteger('origin')->default(0);
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

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
        Schema::dropIfExists('addresses');
    }
}
