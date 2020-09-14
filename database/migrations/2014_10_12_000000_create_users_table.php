<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Contracts\UserContract;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(UserContract::TABLE, function (Blueprint $table) {
            $table->id();
            $table->string(UserContract::STATUS)->default('user');
            $table->string(UserContract::NAME)->nullable();
            $table->smallInteger(UserContract::SEX)->default(0);
            $table->date(UserContract::BIRTHDATE);
            $table->string(UserContract::PHONE)->unique()->nullable();
            $table->timestamp(UserContract::PHONE_VERIFIED_AT)->nullable();
            $table->string(UserContract::EMAIL)->unique()->nullable();
            $table->timestamp(UserContract::EMAIL_VERIFIED_AT)->nullable();
            $table->string(UserContract::ADDRESS)->nullable();
            $table->string(UserContract::TOKEN)->nullable();
            $table->bigInteger(UserContract::REF)->default(UserContract::REF_DEFAULT);
            $table->string(UserContract::AVATAR)->nullable();
            $table->string(UserContract::AVATAR_ORIGINAL)->nullable();
            $table->enum(UserContract::DEL, UserContract::DEL_VALUES)->default(UserContract::DEL_ACTIVE);
            $table->string(UserContract::PASSWORD);
            $table->smallInteger(UserContract::EMAIL_NOTIFICATION)->default(UserContract::EMAIL_NOTIFICATION_DEFAULT);
            $table->smallInteger(UserContract::PUSH_NOTIFICATION)->default(UserContract::PUSH_NOTIFICATION_DEFAULT);
            $table->rememberToken();
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
        Schema::dropIfExists(UserContract::TABLE);
    }
}
