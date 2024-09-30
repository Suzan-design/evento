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
        Schema::create('event_requests', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained('mobile_users')->onDelete('cascade') ;

            $table->string('title') ;

            $table->string('first_name') ;

            $table->string('last_name') ;

            $table->string('phone_number') ;

            $table->date('date') ;

            $table->time('start_time') ;

            $table->time('end_time') ;

            $table->integer('adults');

            $table->integer('child');

            $table->json('images')->nullable() ;

            $table->text('description')->nullable() ;

            $table->unsignedBigInteger('venue_id')->nullable() ;
            $table->foreign('venue_id')->references('id')->on('venues')->nullOnDelete() ;

            $table->json('service_provider_id') ;

            $table->text('additional_notes')->nullable();

            $table->enum('status' , ['Approved' , 'In Progress' , 'Pending'])->default('Pending') ;

            $table->index('venue_id') ;

            $table->index('user_id') ;

            $table->foreignId('event_category_id')->constrained('event_request_categories') ;

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_requests');
    }
};
