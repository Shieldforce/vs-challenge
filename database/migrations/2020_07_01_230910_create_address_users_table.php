<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('address_users', function (Blueprint $table) {
            $table->id();

            $table->integer("cep")->nullable();
            $table->string("street")->nullable();
            $table->string("district")->nullable();
            $table->string("city")->nullable();
            $table->string("state")->nullable();
            $table->string("number")->nullable();
            $table->string("complement")->nullable();
            $table->boolean("main")->nullable();

            $table->unsignedBigInteger("user_id");
            $table->foreign("user_id")
                ->references("id")
                ->on("users")
                ->onDelete("cascade");

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
        Schema::dropIfExists('address_users');
    }
}
