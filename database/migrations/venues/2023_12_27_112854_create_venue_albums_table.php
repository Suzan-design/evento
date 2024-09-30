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
        Schema::create('venue_albums', function (Blueprint $table) {
            $table->id();
            $table->foreignId('venue_id')->constrained('venues')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->string('name');
            $table->json('images')->nullable();
            $table->json('videos')->nullable();

            $table->index('venue_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('venue_albums');
    }
};
