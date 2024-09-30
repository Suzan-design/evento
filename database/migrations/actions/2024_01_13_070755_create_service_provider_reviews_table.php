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
        Schema::create('service_provider_reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('mobile_users')->onDelete('cascade')->onUpdate('cascade') ;
            $table->foreignId('service_provider_id')->constrained('service_providers')->onDelete('cascade')->onUpdate('cascade') ;
            $table->integer('rate') ;
            $table->string('comment')->nullable() ;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_provider_reviews');
    }
};
