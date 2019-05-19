<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('friends', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('friend_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::table('user_metas', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('meta_type_id')->references('id')->on('meta_types')->onDelete('cascade');
        });

        Schema::table('games', function (Blueprint $table) {
            $table->foreign('game_category_id')->references('id')->on('game_categories')->onDelete('cascade');
            $table->foreign('game_type_id')->references('id')->on('game_types')->onDelete('cascade');
        });

        Schema::table('game_metas', function (Blueprint $table) {
            $table->foreign('game_id')->references('id')->on('games')->onDelete('cascade');
            $table->foreign('meta_type_id')->references('id')->on('meta_types')->onDelete('cascade');
        });

        Schema::table('results', function (Blueprint $table) {
            $table->foreign('game_id')->references('id')->on('games')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::table('scores', function (Blueprint $table) {
            $table->foreign('result_id')->references('id')->on('results')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::table('score_metas', function (Blueprint $table) {
           $table->foreign('score_id')->references('id')->on('scores')->onDelete('cascade');
           $table->foreign('meta_type_id')->references('id')->on('meta_types')->onDelete('cascade'); 
        });

        Schema::table('badge_metas', function (Blueprint $table) {
           $table->foreign('badge_id')->references('id')->on('badges')->onDelete('cascade');
           $table->foreign('meta_type_id')->references('id')->on('meta_types')->onDelete('cascade');  
       });

        Schema::table('badge_user', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('badge_id')->references('id')->on('badges')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
