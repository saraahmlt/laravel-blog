<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use  App\Models\Categorie; 
use App\Models\Post; 

return new class extends Migration
{
   /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('categorie_post', function (Blueprint $table) {
            $table->id('id');
            $table->foreignId('category_id')
                  ->constrained('category')
                  ->onDelete('cascade'); 
            $table->foreignId('post_id')
                  ->constrained('posts')
                  ->onDelete('cascade'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('categorie_post');
    }
};