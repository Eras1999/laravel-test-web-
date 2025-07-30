<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('elephant_alerts', function (Blueprint $table) {
            // Drop the foreign key constraint
            $table->dropForeign(['user_id']);
            // Drop the user_id column
            $table->dropColumn('user_id');
        });
    }

    public function down(): void
    {
        Schema::table('elephant_alerts', function (Blueprint $table) {
            // Restore the user_id column and foreign key
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
        });
    }
};