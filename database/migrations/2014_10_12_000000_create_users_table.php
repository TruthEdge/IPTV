<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->float('credits')->nullable();
            $table->string('mobile')->nullable();
            $table->string('email')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('gender')->nullable()->default(0);
            $table->date('birth_date')->nullable();
            $table->string('password')->nullable();
            $table->string('image')->nullable();
            $table->bigInteger('status')->default(0)->nullable();
            $table->bigInteger('user_id')->nullable();
            $table->bigInteger('department_id')->nullable();
            $table->string('api_token')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
