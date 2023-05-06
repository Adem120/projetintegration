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
        Schema::create('series', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->string('description');
            $table->string('thumbnail_url')->default('ddd');
            $table->string('réalisateur');
            $table->string('langue');
            $table->Integer('nbepisodes');
            $table->foreignId('categorie_id')->constrained('categories');
            $table->timestamps();
    
        });
        //
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
