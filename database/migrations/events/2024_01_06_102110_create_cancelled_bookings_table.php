<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cancelled_bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('mobile_users')->onDelete('set null');
            $table->foreignId('event_id')->nullable()->constrained('events')->onDelete('set null');
            $table->foreignId('promo_code_id')->nullable()->constrained('promo_codes')->onDelete('set null');
            $table->foreignId('bookings_id')->nullable()->constrained('bookings')->onDelete('set null');

            //recovery
            $table->string('user_phone_number');
            $table->string('event_title');
            $table->string('class_type');

            //ID For every ticket
            $table->string('first_name');
            $table->string('last_name');
            $table->integer('age');
            $table->string('phone_number');
            $table->json('amenities');

            //prices
            $table->integer('class_ticket_price') ;
            $table->double('amount');

            //Canceled reason
            $table->text('reason');

            $table->enum('status', ['pending', 'paid'])->default('pending');

            $table->index('user_id');
            $table->index('event_id');
            $table->index('bookings_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cancelled_bookings');
    }
};
