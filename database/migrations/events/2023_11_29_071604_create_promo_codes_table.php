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
        Schema::create('promo_codes', function (Blueprint $table) {
            $table->id();
            $table->softDeletes() ;

            $table->string('title') ;

            $table->text('description') ;

            $table->string('image') ;

            $table->string('code')->unique() ;

            $table->integer('discount') ;

            $table->integer('limit') ;

            $table->dateTime('start-date') ;

            $table->dateTime('end-date') ;


            $table->string('target_categories')->nullable();
            $table->string('target_ages')->nullable();
            $table->string('target_states')->nullable();
            $table->string('target_bookings')->nullable();

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promo_codes');
    }
};
