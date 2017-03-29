<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTcategoryTlistTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tcategory_tlist', function (Blueprint $table) {
            $table->integer('tcategory_id')->unsigned()->index();
			$table->foreign('tcategory_id')->references('id')->on('tcategories')->onDelete('cascade');
			$table->integer('tlist_id')->unsigned()->index();
			$table->foreign('tlist_id')->references('id')->on('tlists')->onDelete('cascade');
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
        Schema::dropIfExists('tcategory_tlist');
    }
}
