<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommunityBlogsTable extends Migration
{
    public function up()
    {
        Schema::create('community_blogs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('user_credentials')->onDelete('cascade');
            $table->string('title');
            $table->text('content');
            $table->string('image')->nullable();
            $table->date('date');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('community_blogs');
    }
}