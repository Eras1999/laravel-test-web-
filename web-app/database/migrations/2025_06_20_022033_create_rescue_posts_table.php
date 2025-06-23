<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('rescue_posts', function (Blueprint $table) {
            $table->id();
            $table->string('author_name');
            $table->string('animal_type');
            $table->string('image')->nullable();
            $table->string('healthy_status');
            $table->string('district');
            $table->string('city')->nullable();
            $table->string('place')->nullable();
            $table->text('description');
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->boolean('rescued')->default(false);
            $table->string('user_id')->nullable(); // To link with the user who posted
            $table->json('comments')->nullable(); // Added comments as JSON
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('rescue_posts');
    }
};