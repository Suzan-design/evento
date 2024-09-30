<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('organizer_follows', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mobile_user_id')->constrained('mobile_users')->onDelete('cascade')->onUpdate('cascade') ;
            $table->foreignId('organizer_id')->constrained('organizers')->onDelete('cascade')->onUpdate('cascade') ;

            $table->index('mobile_user_id') ;
            $table->index('organizer_id') ;

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('organizer_follows');
    }
};
