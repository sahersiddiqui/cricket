<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablePoints extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('points', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('match_id')->nullable();
            $table->foreign('match_id')->references('id')->on('matches')->onDelete('cascade')->onUpdate('NO ACTION');

            $table->unsignedBigInteger('team_id')->nullable();
            $table->foreign('team_id')->references('id')->on('teams')->onDelete('cascade')->onUpdate('NO ACTION');

            $table->unsignedInteger('points')->nullable();
            
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
        Schema::dropIfExists('points');
    }
}
