<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAuthorNameToCommunityBlogsTable extends Migration
{
    public function up()
    {
        Schema::table('community_blogs', function (Blueprint $table) {
            $table->string('author_name')->nullable()->after('user_id');
        });
    }

    public function down()
    {
        Schema::table('community_blogs', function (Blueprint $table) {
            $table->dropColumn('author_name');
        });
    }
}