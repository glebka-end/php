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
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->unsignedBigInteger('from_profile_id');
            $table->foreign('from_profile_id')->references('id')->on('profiles')
            ->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger('to_profile_id');
            $table->foreign('to_profile_id')->references('id')->on('profiles')
            ->onDelete('cascade')->onUpdate('cascade');

            $table->Integer('statuse');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
