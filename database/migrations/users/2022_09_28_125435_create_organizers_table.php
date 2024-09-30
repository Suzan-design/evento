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
        Schema::create('organizers', function (Blueprint $table) {
            $table->id();
            $table->softDeletes() ;
            $table->foreignId('mobile_user_id')->unique()->constrained('mobile_users')->onDelete('cascade');
            $table->string('name');
            $table->text('bio');
            $table->text('covering_area');
            $table->string('other_category')->nullable() ;
            $table->string('profile')->nullable() ;
            $table->string('cover')->nullable() ;
            $table->enum('type', ['pending'  , 'Approved']) ;
            $table->index('mobile_user_id') ;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organizers');
    }
};
