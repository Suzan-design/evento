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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->softDeletes() ;

            $table->unsignedBigInteger('organizer_id')->nullable();
            $table->foreign('organizer_id')->references('id')->on('organizers')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->string('title') ;

            $table->string('title_ar') ;

            $table->unsignedBigInteger('venue_id')->nullable();
            $table->foreign('venue_id')->references('id')->on('venues')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->integer('capacity') ;

            $table->dateTime('start_date') ;

            $table->dateTime('end_date') ;

            $table->integer('ticket_price') ;

            $table->text('description') ;

            $table->text('description_ar') ;

            $table->enum('type' , ['normal' ,'featured'])->default('normal') ;

            $table->json('videos')->nullable();

            $table->json('images');

            $table->string('website')->nullable() ;

            $table->string('instagram')->nullable() ;

            $table->string('facebook')->nullable();
            
            $table->string('discount_type');

            $table->integer('app_taxes') ;
            
            $table->double('ecash_taxes')->default(200) ;

            $table->text('refund_policy') ;

            $table->text('cancellation_policy') ;
            
            $table->integer('cancellation_time') ;

            $table->text('refund_policy_ar') ;

            $table->text('cancellation_policy_ar') ;

            $table->timestamps();

            $table->index('venue_id') ;
            $table->index('organizer_id') ;
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
