<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Contracts\brands;

class CreateBrandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(brands::NAME, function (Blueprint $table) {
            $table->id();
            $table->char(brands::CODE, brands::CODE_LENGTH)->unique();
            $table->string(brands::TITLE);
            $table->integer(brands::ORDER);
            $table->enum(brands::DEL, brands::DEL_VALUES)->default(brands::DEL_ACTIVE);
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
        Schema::dropIfExists(brands::NAME);
    }
}
