<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('elephant_alerts', function (Blueprint $table) {
            $table->dropColumn('place_name');
        });
    }

    public function down()
    {
        Schema::table('elephant_alerts', function (Blueprint $table) {
            $table->string('place_name')->nullable()->after('longitude');
        });
    }
};