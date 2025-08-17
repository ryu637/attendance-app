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
        Schema::create('attendances', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('participant_id');
                $table->unsignedBigInteger('candidate_id');
                $table->enum('status', ['yes', 'maybe', 'no'])->nullable(); // ○=yes, △=maybe, ×=no
                $table->text('comment')->nullable();
                $table->timestamps();

                $table->foreign('participant_id')->references('id')->on('participants')->onDelete('cascade');
                $table->foreign('candidate_id')->references('id')->on('candidates')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};