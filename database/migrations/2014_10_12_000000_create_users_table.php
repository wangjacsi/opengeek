<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('email')->unique();
            $table->string('slug')->unique();
            $table->string('password');
            $table->json('settings');
            $table->string('avatar')->nullable();
            $table->text('aboutme')->nullable();
            $table->enum('active', ['active', 'inactive', 'dormant', 'delected'])->default('inactive');
            $table->enum('level', ['lv1', 'lv2','lv3','lv4','lv5','lv6','lv7','lv8','lv9'])->default('lv1');
            $table->timestamp('last_login')->nullable();
            $table->string('ip_address')->nullable();
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
