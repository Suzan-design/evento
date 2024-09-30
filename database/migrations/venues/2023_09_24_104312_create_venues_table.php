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
        Schema::create('venues', function (Blueprint $table) {
            $table->id();

            $table->string('name') ;
            $table->string('name_ar') ;


            $table->integer('capacity') ;
            $table->enum('governorate' , ['Aleppo','Al-Ḥasakah','Al-Qamishli','Al-Qunayṭirah','Al-Raqqah','Al-Suwayda','Damascus','Daraa','Dayr al-Zawr','Ḥamah','Homs','Idlib','latakia' , 'Rif Dimashq']);

            $table->string('location_description') ;
            $table->string('location_description_ar') ;


            $table->text('description') ;
            $table->text('description_ar') ;


            $table->double('latitude', 10, 6); // Adjust precision as needed

            $table->double('longitude', 10, 6); // Adjust precision as needed

            $table->string('profile') ;

            $table->string('contact_number') ;

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('venues');
    }
};
