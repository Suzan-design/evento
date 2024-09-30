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
        Schema::create('organizer_updates', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('bio');
            $table->text('covering_area');
            $table->string('other_category')->nullable() ;
            $table->string('profile')->nullable() ;
            $table->string('cover')->nullable() ;
            $table->foreignId('organizer_id')->constrained('organizers')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organizer_updates');
    }
};
