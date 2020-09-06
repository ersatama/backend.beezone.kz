<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Contracts\Goods;

class CreateGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(Goods::NAME, function (Blueprint $table) {
            $table->id();
            $table->string(Goods::TITLE)->nullable();
            $table->string(Goods::TITLE_1C)->nullable();
            $table->string(Goods::THUMBNAIL_IMG)->nullable();
            $table->string(Goods::FEATURED_IMG)->nullable();
            $table->string(Goods::FLASH_IMG)->nullable();
            $table->string(Goods::TAGS)->nullable();
            $table->text(Goods::DESCRIPTION)->nullable();
            $table->string(Goods::META_TITLE)->nullable();
            $table->text(Goods::META_DESCRIPTION)->nullable();
            $table->string(Goods::META_IMG)->nullable();
            $table->enum(Goods::DEL, Goods::DEL_VALUES)->default(Goods::DEL_ACTIVE);
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
        Schema::dropIfExists(Goods::NAME);
    }
}
