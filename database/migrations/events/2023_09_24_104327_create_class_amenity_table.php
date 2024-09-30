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
        Schema::create('class_amenity', function (Blueprint $table) {
            $table->id();
            $table->foreignId('amenity_id')->constrained('amenities')
                ->onDelete('cascade')->onUpdate('cascade') ;
            $table->foreignId('event_class_id')->constrained('event_classes')
                ->onDelete('cascade')->onUpdate('cascade') ;

            $table->index('amenity_id') ;
            $table->index('event_class_id') ;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('class_amenity');
    }
};
