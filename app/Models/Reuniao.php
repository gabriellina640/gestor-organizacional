<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reuniao extends Model
{
    use HasFactory;

    protected $table = 'reunioes'; // nome da tabela

    protected $fillable = [
        'titulo',
        'local',
        'data',
        'hora',
        'descricao',
        'status',
    ];

    protected $dates = [
        'data',
        'created_at',
        'updated_at',
    ];

    /**
     * Relação muitos-para-muitos com Participant
     */
    public function participantes()
    {
        return $this->belongsToMany(
            Participant::class,      // Modelo relacionado
            'participant_reuniao',   // Nome da tabela pivot
            'reuniao_id',            // FK desta tabela na pivot
            'participant_id'         // FK do modelo relacionado na pivot
        )
        ->withPivot('presente')     // se você quer pegar campo "presente" da pivot
        ->withTimestamps();         // se a pivot tiver created_at/updated_at
    }
}
