<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Kalnoy\Nestedset\NestedSet;

class AddNestedsetColumnsTcategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tcategories', function (Blueprint $table) {
            //NestedSet::columns($table);
            $table->unsignedInteger('_lft');
            $table->unsignedInteger('_rgt');
            $table->unsignedInteger('parent_id')->nullable()->change();
            $table->index(['_lft', '_rgt', 'parent_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tcategories', function (Blueprint $table) {
            //NestedSet::dropColumns($table);
            $table->dropIndex('tcategories__lft__rgt_parent_id_index');
            $table->dropColumn(['_lft', '_rgt']);
        });
    }
}
