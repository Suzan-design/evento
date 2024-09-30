<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new
class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('mobile_users', function (Blueprint $table) {
            $table->softDeletes() ;
            $table->id();

            $table->string('first_name');
            $table->string('last_name');
            $table->string('phone_number')->unique() ;
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->enum('gender' , ['male' , 'female'])->nullable() ;
            $table->date('birth_date')->nullable() ;
            $table->enum('state' , ['Aleppo','Al-Ḥasakah','Tartus','Al-Qunayṭirah','Al-Raqqah','Al-Suwayda','Damascus','Daraa','Dayr al-Zawr','Ḥamah','Homs','Idlib','latakia' , 'Rif Dimashq'])->nullable();
            $table->string('image')->nullable() ;
            $table->boolean('is_complete')->default(false) ;
            $table->boolean('is_verified')->default(false) ;
            $table->enum('type' , ['normal' , 'private' ,'organizer' , 'service_provider' , 'verified'])->default('normal') ;
            $table->enum('active_type' , ['normal' , 'blocked']);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mobile_users');
    }
};
