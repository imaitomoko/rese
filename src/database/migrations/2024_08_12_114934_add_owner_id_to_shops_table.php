<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOwnerIdToShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('shops', function (Blueprint $table) {
            $table->unsignedBigInteger('owner_id')->after('id')->nullable(); 
            $table->foreign('owner_id')->references('id')->on('owners')->onDelete('cascade');
            //
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('shops', function (Blueprint $table) {
            $table->dropForeign(['owner_id']);
            $table->dropColumn('owner_id');
            //
        });
    }
}
