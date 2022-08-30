<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MainSchema extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('player', function(Blueprint $table)
        {
            $table->id();
            $table->string('name', 150)->nullable(false)->unique();
        });

        Schema::create('teams', function(Blueprint $table)
        {
            $table->id();
            $table->string('name', 255)->nullable(false)->unique();

            $table->unsignedBigInteger('player_one_id')->nullable(false);
            $table->foreign('player_one_id')->references('id')->on('player')->onDelete('cascade');
            $table->unsignedBigInteger('player_two_id')->nullable(false);
            $table->foreign('player_two_id')->references('id')->on('player')->onDelete('cascade');
        });

        Schema::create('championships', function(Blueprint $table)
        {
            $table->id();
            $table->string('name', 255)->unique()->comment('the name of the championship');
        });

        Schema::create('matches', function(Blueprint $table)
        {
            $table->id();

            $table->unsignedBigInteger('championship_id')->nullable(false);
            $table->foreign('championship_id')->references('id')->on('championships')->onDelete('cascade');

            $table->unsignedBigInteger('team_one_id')->nullable(false);
            $table->foreign('team_one_id')->references('id')->on('teams')->onDelete('cascade');
            $table->unsignedBigInteger('team_two_id')->nullable(false);
            $table->foreign('team_two_id')->references('id')->on('teams')->onDelete('cascade');

            $table->date('date')->unique();
            $table->unsignedInteger('team_one_score')->nullable(true);
            $table->unsignedInteger('team_two_score')->nullable(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('matches', function(Blueprint $table)
        {
            $table->dropForeign(['championship_id']);
            $table->dropForeign(['team_one_id']);
            $table->dropForeign(['team_two_id']);
            $table->drop();
        });

        Schema::table('teams', function(Blueprint $table)
        {
            $table->dropForeign(['player_one_id']);
            $table->dropForeign(['player_two_id']);
            $table->drop();
        });

        Schema::table('player', function(Blueprint $table)
        {
            $table->drop();
        });

        Schema::table('championships', function(Blueprint $table)
        {
            $table->drop();
        });

    }
}
