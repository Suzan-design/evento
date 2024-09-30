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
        Schema::create('event_comments', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained('mobile_users')
                ->onDelete('cascade');

            $table->foreignId('event_id')->constrained('events')
                ->onDelete('cascade') ;

            $table->string('comment') ;

            $table->index('event_id');
            $table->index('user_id') ;// Creating a non-clustered index on user_id

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_comments');
    }

};
