<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reuniao extends Model
{
    use HasFactory;

    protected $table = 'reunioes'; // nome da tabela

    // Campos que podem ser preenchidos em massa
    protected $fillable = [
        'titulo',
        'local',
        'data',
        'hora',
        'descricao',
        'status',
    ];

    // Se quiser, pode tratar 'data' como Carbon
    protected $dates = [
        'data',
        'created_at',
        'updated_at',
    ];
}
