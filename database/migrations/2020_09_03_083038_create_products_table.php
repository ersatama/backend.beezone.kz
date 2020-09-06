<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Contracts\Product;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(Product::NAME, function (Blueprint $table) {
            $table->id();
            $table->string(Product::TITLE);
            $table->string(Product::IMG);
            $table->string(Product::ICON);
            $table->string(Product::SLUG);
            $table->enum(Product::DEL, Product::DEL_VALUES)->default(Product::DEL_ACTIVE);
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
        Schema::dropIfExists(Product::NAME);
    }
}
