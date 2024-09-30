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
        Schema::create('reels', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('event_id')->nullable() ;
            $table->foreign('event_id')->references('id')->on('events') ->onDelete('cascade') ;

            $table->unsignedBigInteger('organizer_id')->nullable() ;
            $table->foreign('organizer_id')->references('id')->on('organizers')->onDelete('cascade') ;

            $table->unsignedBigInteger('venue_id')->nullable() ;
            $table->foreign('venue_id')->references('id')->on('venues')->onDelete('cascade') ;

            $table->json('videos')->nullable();
            $table->json('images')->nullable();

            $table->text('description')->nullable();

            $table->text('description_ar')->nullable();

            $table->index('event_id') ;
            $table->index('organizer_id') ;
            $table->index('venue_id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reels');
    }
};
