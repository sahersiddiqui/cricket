<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableMatche extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matches', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('first_team_id')->nullable()->comment('Team Id of first team');
            $table->foreign('first_team_id')->references('id')->on('teams')->onDelete('cascade')->onUpdate('NO ACTION');

            $table->unsignedBigInteger('second_team_id')->nullable()->comment('Team Id of Second team');
            $table->foreign('second_team_id')->references('id')->on('teams')->onDelete('cascade')->onUpdate('NO ACTION');

            $table->enum('result',['0','1'])->default('0')->comment('0:Draw,1:Winner');
            $table->datetime('match_date')->nullable();
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
        Schema::dropIfExists('matches');
    }
}
