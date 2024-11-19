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
        Schema::create('new_england_places', function (Blueprint $table) {
            $table->id();
            $table->foreignId('new_england_state_id')->constrained('new_england_states')->onDelete('cascade');
            $table->string('address');
            $table->decimal('lat', 10, 7);
            $table->decimal('lng', 10, 7);
            $table->string('project_name'); 
            $table->string('city'); 
            $table->string('receipient_name'); 
            $table->string('project_type'); 
            $table->string('project_target')->nullable();   
            $table->text('description');          
            $table->year('year');                 
            $table->string('contact');            
            $table->string('project_link');  
            $table->string('facebook_link')->nullable();     
            $table->string('youtube_link')->nullable();     
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('new_england_places');
    }
};
