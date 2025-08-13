<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('meetings', function (Blueprint $table) {
            $table->date('date')->nullable();
            $table->time('time')->nullable();
        });
    }

    public function down()
    {
        Schema::table('meetings', function (Blueprint $table) {
            $table->dropColumn(['date', 'time']);
        });
    }
};
