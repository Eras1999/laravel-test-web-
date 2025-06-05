<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('adoption_posts', function (Blueprint $table) {
            $table->id();
            $table->string('author_name');
            $table->string('title');
            $table->enum('category', ['dog', 'cat']);
            $table->text('description');
            $table->string('district');
            $table->string('city');
            $table->string('nearby_city');
            $table->string('mobile_number');
            $table->string('image')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected', 'expired', 'adopted'])->default('pending');
            $table->timestamp('approved_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('adoption_posts');
    }
};