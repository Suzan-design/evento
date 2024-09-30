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
        Schema::create('event_classes', function (Blueprint $table) {
            $table->id();

            $table->foreignId('event_id')->constrained('events')->onDelete('cascade') ;

            $table->string('code') ;

            $table->text('description') ;
            $table->text('description_ar') ;

            $table->float('ticket_price');

            $table->integer('ticket_number');

            $table->index('code') ;

            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('event_classes');
    }

};
