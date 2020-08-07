<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablePlayer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('players', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('team_id')->nullable();
            $table->foreign('team_id')->references('id')->on('teams')->onDelete('set null')->onUpdate('NO ACTION');

            $table->string('firstname')->nullable();
            $table->string('lastname')->nullable();
            $table->string('image_uri')->nullable();
            $table->unsignedInteger('jersey_number')->nullable();
            $table->string('country')->nullable();
            $table->unsignedInteger('matches')->default('0')->nullable();
            $table->unsignedInteger('runs')->default('0')->nullable();
            $table->unsignedInteger('highest_score')->default('0')->nullable();
            $table->unsignedInteger('total_fifties')->default('0')->nullable();
            $table->unsignedInteger('total_hundreds')->default('0')->nullable();
            
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('players');
    }
}
