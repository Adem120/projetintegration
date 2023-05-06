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
    {     Schema::create('episodes', function (Blueprint $table) {
        $table->id();
        $table->string('titre');
        $table->string('duration');
        $table->string('url');
        $table->string('thumbnial_url');
        $table->Integer('numero_episode');
        $table->string('numero_saison');
        $table->foreignId('serie_id')->constrained('series');
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
        //
    }
};
