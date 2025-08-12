<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::create('organizations', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->unsignedTinyInteger('work_days_per_week'); // ex: 5 dias
        $table->unsignedTinyInteger('work_hours_per_day'); // ex: 6 horas
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organizations');
    }
};
