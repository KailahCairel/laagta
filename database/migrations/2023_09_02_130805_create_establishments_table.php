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
        Schema::create('establishments', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->string('location');
            
            $table->string('email')->nullable();
            $table->string('phone')->nullable(); 

            $table->integer('entrance_fee_adult')->nullable(); 
            $table->integer('entrance_fee_child')->nullable(); 

            $table->unsignedBigInteger('destination_id');
            $table->boolean('status')->default(true);
            
            $table->boolean('has_accomodation')->default(true);
            $table->boolean('has_venues')->default(true);
            $table->boolean('has_rides')->default(true);
            // Add more fields as needed
            $table->timestamps();

            $table->foreign('destination_id')->references('id')->on('destinations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('establishments');
    }
};
