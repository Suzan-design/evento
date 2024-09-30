<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('event_category_mobile_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('events_category_id')->constrained('event_categories')->onDelete('cascade');
            $table->foreignId('mobile_user_id')->constrained('mobile_users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_category_mobile_user');
    }
};
