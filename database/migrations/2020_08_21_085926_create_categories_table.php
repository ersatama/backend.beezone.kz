<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Contracts\Category;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(Category::NAME, function (Blueprint $table) {
            $table->id();
            $table->bigInteger(Category::BRAND_ID);
            $table->bigInteger(Category::GOODS_ID);
            $table->string(Category::IMG);
            $table->string(Category::TITLE);
            $table->integer(Category::MAX);
            $table->integer(Category::LIMIT);
            $table->enum(Category::DEL, Category::DEL_VALUES)->default(Category::DEL_ACTIVE);
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
        Schema::dropIfExists(Category::NAME);
    }
}
