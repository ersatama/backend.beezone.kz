<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Contracts\Orders;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(Orders::NAME, function (Blueprint $table) {
            $table->id();
            $table->string(Orders::CODE);
            $table->bigInteger(Orders::USER_ID);
            $table->string(Orders::ADDRESS);
            $table->bigInteger(Orders::TIME_ID);
            $table->bigInteger(Orders::PAYMENT_ID);
            $table->string(Orders::COMMENT)->nullable();
            $table->smallInteger(Orders::STATUS);
            $table->enum(Orders::DEL, Orders::DEL_VALUES)->default(Orders::DEL_ACTIVE);
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
        Schema::dropIfExists(Orders::NAME);
    }
}
