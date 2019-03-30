<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('order_id')->index();
            $table->string('isbn', 13)->index();
            $table->string('item_title');
            $table->text('item_description')->nullable();
            $table->decimal('item_price', 4, 2);
            $table->unsignedTinyInteger('quantity');
            $table->timestamps();

            $table->unique( ['order_id','isbn'] );

            //foreignkey
            $table->foreign('order_id')->on('orders')->references('id')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_items');
    }
}
