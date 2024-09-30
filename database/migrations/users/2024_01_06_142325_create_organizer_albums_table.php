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
        Schema::create('organizer_albums', function (Blueprint $table) {
            $table->id();
            $table->foreignId('organizer_id')->constrained('organizers')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->string('name');
            $table->json('images')->nullable();
            $table->json('videos')->nullable();

            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('organizer_albums');
    }
};
