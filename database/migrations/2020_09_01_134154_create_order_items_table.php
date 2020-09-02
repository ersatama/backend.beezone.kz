<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Contracts\OrderItems;

class CreateOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(OrderItems::NAME, function (Blueprint $table) {
            $table->id();
            $table->bigInteger(OrderItems::USER_ID);
            $table->bigInteger(OrderItems::ORDER_ID);
            $table->bigInteger(OrderItems::CATEGORY_ID);
            $table->string(OrderItems::TITLE);
            $table->bigInteger(OrderItems::COUNT);
            $table->string(OrderItems::PRICE);
            $table->enum(OrderItems::DEL, OrderItems::DEL_VALUES)->default(OrderItems::DEL_ACTIVE);
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
        Schema::dropIfExists(OrderItems::NAME);
    }
}
