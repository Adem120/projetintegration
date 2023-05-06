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
    {Schema::create('film_m_s', function (Blueprint $table) {
        $table->id();
        $table->string('titre');
        $table->string('description');
        $table->string('thumbnial_url');
        $table->string('réalisateur');
        $table->string('langue');
        $table->Integer('duration');
        $table->string('url');
        $table->foreignId('categorie_id')->constrained('categories');
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
