<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMetableColumnsToMetadataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('metadata', function (Blueprint $table) {
            $table->unsignedBigInteger('metable_id')->after('id');
            $table->string('metable_type')->after('metable_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('metadata', function (Blueprint $table) {
            //
        });
    }
}
