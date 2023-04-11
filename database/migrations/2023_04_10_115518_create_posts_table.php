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
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
         //   $table->foreign('id','post_comments_fk')->on('comments')->references('id_post');
        //    $table->id('id_user');
           
            $table->string('title');
            $table->text('contente');
            $table->string('image')->nullable();
            $table->unsignedBigInteger('likes')->nullable();
            $table->boolean('isPublished')->default(1);
            $table->timestamps();

           // $table->unsignedBigInteger();
           // $table->timestamps();
           // $table->timestamps();

        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
