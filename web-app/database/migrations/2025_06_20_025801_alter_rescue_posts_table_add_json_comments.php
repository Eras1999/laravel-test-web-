<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('rescue_posts', function (Blueprint $table) {
            $table->json('comments')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('rescue_posts', function (Blueprint $table) {
            $table->text('comments')->nullable()->change();
        });
    }
};