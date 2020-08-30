<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Contracts\Matrix;

class CreateMatricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(Matrix::NAME, function (Blueprint $table) {
            $table->id();
            $table->bigInteger(Matrix::CATEGORY_ID);
            $table->integer(Matrix::LIMIT);
            $table->integer(Matrix::PRICE);
            $table->enum(Matrix::DEL, Matrix::DEL_VALUES)->default(Matrix::DEL_ACTIVE);
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
        Schema::dropIfExists('matrices');
    }
}
