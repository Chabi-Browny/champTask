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
            $table->string('name', 150)->unique();
        });

        Schema::create('teams', function(Blueprint $table)
        {
            $table->id();
            $table->string('name', 255)->nullable(false)->unique()->comment('the name of the team');

            $table->unsignedBigInteger('player_one_id')->nullable(false)->comment('striker');
            $table->foreign('player_one_id')->references('id')->on('player')->onDelete('cascade');
            $table->unsignedBigInteger('player_two_id')->nullable(false)->comment('goalkeeper');
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

            $table->unsignedBigInteger('tema_one_id')->nullable(false);
            $table->foreign('tema_one_id')->references('id')->on('teams')->onDelete('cascade');
            $table->unsignedBigInteger('tema_two_id')->nullable(false);
            $table->foreign('tema_two_id')->references('id')->on('teams')->onDelete('cascade');

            $table->date('date')->unique();
            $table->unsignedInteger('tema_one_score')->nullable(true);
            $table->unsignedInteger('tema_two_score')->nullable(true);
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
            $table->dropForeign(['tema_one_id']);
            $table->dropForeign(['tema_two_id']);
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
