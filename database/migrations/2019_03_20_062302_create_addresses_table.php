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
            $table->increments('id');
            $table->string('name', 60);
            $table->string('address', 80);
            $table->string('city', 30);
            $table->string('state', 20)->nullable();
            $table->string('zip', 10)->nullable();
            $table->string('country', 50);
            $table->boolean('default')->nullable();
            $table->boolean('billing')->nullable();
            $table->unsignedInteger('user_id')->index();
            $table->timestamps();

            //foreignkey
            $table->foreign('user_id')->on('users')->references('id')->onDelete('cascade')->onUpdate('cascade');
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
