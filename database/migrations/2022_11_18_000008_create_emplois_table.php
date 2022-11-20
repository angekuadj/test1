<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emplois', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('classe_id');
            $table->unsignedBigInteger('salle_id');
            $table->unsignedBigInteger('user_id');
            $table->string('Ddebut');
            $table->string('Dfin');
            $table->unsignedBigInteger('prof_id');

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
        Schema::dropIfExists('emplois');
    }
};
