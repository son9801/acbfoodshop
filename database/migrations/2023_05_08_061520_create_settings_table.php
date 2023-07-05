<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            
            $table->string('website_name')->nullable();
            $table->string('website_url')->nullable();  
            $table->string('address')->nullable();  
            $table->string('phone')->nullable();  
            $table->string('email')->nullable();  
            $table->string('facebook')->nullable();  
            $table->string('youtube')->nullable();  

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
};
