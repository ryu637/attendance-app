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
        Schema::create('events', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('title');
                $table->text('description')->nullable();
                $table->unsignedBigInteger('creator_user_id')->nullable();
                $table->string('token')->unique();
                $table->timestamps();

                // 外部キー制約（usersテーブルがある場合）
                $table->foreign('creator_user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
