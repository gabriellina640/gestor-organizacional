<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('reunioes', function (Blueprint $table) {
            // Renomeia a coluna 'nome' para 'titulo'
            if (Schema::hasColumn('reunioes', 'nome')) {
                $table->renameColumn('nome', 'titulo');
            }

            // Adiciona colunas que ainda não existem
            if (!Schema::hasColumn('reunioes', 'local')) {
                $table->string('local')->after('titulo');
            }

            if (!Schema::hasColumn('reunioes', 'data')) {
                $table->date('data')->after('local');
            }

            if (!Schema::hasColumn('reunioes', 'hora')) {
                $table->time('hora')->after('data');
            }

            if (!Schema::hasColumn('reunioes', 'descricao')) {
                $table->text('descricao')->nullable()->after('hora');
            }
        });
    }

    public function down(): void
    {
        Schema::table('reunioes', function (Blueprint $table) {
            // Reverte a coluna 'titulo' para 'nome'
            if (Schema::hasColumn('reunioes', 'título')) {
                $table->renameColumn('título', 'nome');
            }

            // Remove colunas adicionadas
            if (Schema::hasColumn('reunioes', 'local')) {
                $table->dropColumn('local');
            }

            if (Schema::hasColumn('reunioes', 'data')) {
                $table->dropColumn('data');
            }

            if (Schema::hasColumn('reunioes', 'hora')) {
                $table->dropColumn('hora');
            }

            if (Schema::hasColumn('reunioes', 'descricao')) {
                $table->dropColumn('descricao');
            }
        });
    }
};
