<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCategoryIdToContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contacts', function (Blueprint $table) {
            $table->unsignedBigInteger('category_id')->after('email');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */

     public function down()
     {
         Schema::table('contacts', function (Blueprint $table) {
             $table->dropColumn('category_id');
         });
     }
}
