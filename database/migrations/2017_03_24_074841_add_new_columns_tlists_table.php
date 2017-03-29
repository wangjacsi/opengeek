<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewColumnsTlistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tlists', function (Blueprint $table) {
            $table->unsignedTinyInteger('status')->default(1);
            $table->unsignedTinyInteger('progress')->default(5);
            $table->json('settings')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tlists', function (Blueprint $table) {
            $table->dropColumn(['status', 'progress', 'settings']);
        });
    }
}
