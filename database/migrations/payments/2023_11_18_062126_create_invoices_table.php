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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id()->startingValue(100070);
            $table->unsignedBigInteger('mobile_user_id')->nullable();
            $table->foreign('mobile_user_id')->references('id')->on('mobile_users')
                ->onDelete('set null');

            $table->integer('amount') ;

            $table->text('description') ;

            $table->bigInteger('external_id')->unique() ;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */

    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
