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
    Schema::create('participant_reuniao', function (Blueprint $table) {
        $table->id();
        $table->foreignId('participant_id')->constrained('participants')->onDelete('cascade');
        $table->foreignId('reuniao_id')->constrained('reunioes')->onDelete('cascade');
        $table->boolean('presente')->default(false);
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('participant_reuniao');
    }
};
