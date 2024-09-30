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
        Schema::create('service_providers', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->unique()->constrained('mobile_users') ;

            $table->string('name') ;

            $table->string('name_ar') ;

            $table->text('bio') ;

            $table->text('bio_ar') ;

            $table->string('location_work_governorate') ;

            $table->foreignId('category_id')->nullable();
            $table->foreign('category_id')
                ->references('id')
                ->on('service_categories')
                ->onDelete('SET NULL');

            $table->text('description');

            $table->text('description_ar');

            $table->string('profile');

            $table->string('cover');

            $table->double('latitude', 10, 6)->nullable(); // Adjust precision as needed

            $table->double('longitude', 10, 6)->nullable(); // Adjust precision as needed

            $table->enum('type' , ['pending' , 'Approved']) ;
            $table->index('category_id') ;
            $table->index('user_id') ;

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_providers');
    }
};
