<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTcategroyidColumnTlistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tlists', function (Blueprint $table) {
            $table->unsignedInteger('tcategory_id');
            $table->foreign('tcategory_id')->references('id')->on('tcategories')->onDelete('cascade');
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
            $table->dropColumn(['tcategory_id']);
        });
    }
}
