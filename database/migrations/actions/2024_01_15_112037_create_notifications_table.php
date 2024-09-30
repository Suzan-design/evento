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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->string('title') ;
            $table->string('title_ar') ;
            $table->text('description') ;
            $table->text('description_ar') ;
            $table->foreignId('user_id')->constrained('mobile_users')->onDelete('cascade')->onUpdate('cascade') ;
            $table->index('user_id');
            $table->boolean('seen_type')->default(false) ;
            $table->boolean('live_type')->default(false) ;

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
