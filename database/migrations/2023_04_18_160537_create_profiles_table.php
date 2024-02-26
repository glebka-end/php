<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();

              $table->unsignedBigInteger('user_id');
              $table->foreign('user_id')->unique()->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
              $table->string('User_image')->nullable();
              $table->boolean('is_online')->default(0);
              $table->string('status')->nullable();
              $table->unsignedBigInteger('friends')->default(0);
              $table->unsignedBigInteger('total_number_of_games')->default(0);         
              $table->unsignedBigInteger('won_games')->default(0);
              $table->unsignedBigInteger('lost_games')->default(0);
              //$table->unsignedBigInteger('likes')->nullable();
              $table->timestamps();

            //   $table->bigIncrements('id');
            //   $table->unsignedBigInteger('user_id')->nullable();
            //   $table->foreign('user_id')->references('id')->on('users');
            //   $table->date('dob');
            //   $table->text('bio');
            //   $table->string('facebook');
            //   $table->string('twitter');
            //   $table->string('github');
            //   $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
