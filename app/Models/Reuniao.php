<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reuniao extends Model
{
    use HasFactory;

    protected $table = 'reunioes';

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
            Participant::class,       // Modelo relacionado
            'participant_reuniao',    // Nome da tabela pivot
            'reuniao_id',             // Chave estrangeira desta tabela na pivot
            'participant_id'          // Chave estrangeira do modelo relacionado
        )
        ->withPivot('presente')       // Campo extra na pivot
        ->withTimestamps();           // Se a pivot tiver created_at/updated_at
    }
}
