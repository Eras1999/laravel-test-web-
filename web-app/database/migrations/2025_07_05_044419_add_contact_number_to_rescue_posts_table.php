<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('rescue_posts', function (Blueprint $table) {
            $table->string('contact_number')->nullable()->after('description');
        });
    }

    public function down(): void
    {
        Schema::table('rescue_posts', function (Blueprint $table) {
            $table->dropColumn('contact_number');
        });
    }
};