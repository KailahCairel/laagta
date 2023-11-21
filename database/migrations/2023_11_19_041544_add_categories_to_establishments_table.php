<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCategoriesToEstablishmentsTable extends Migration
{
    public function up()
    {
        Schema::table('establishments', function (Blueprint $table) {
            $table->string('categories')->nullable();
        });
    }

    public function down()
    {
        Schema::table('establishments', function (Blueprint $table) {
            $table->dropColumn('categories');
        });
    }
}
