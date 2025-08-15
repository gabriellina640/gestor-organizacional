<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'cargo'
    ];

    // Relação many-to-many com Reuniao
    public function reunioes()
    {
        return $this->belongsToMany(
            Reuniao::class,         // Modelo relacionado
            'participant_reuniao',  // Nome da tabela pivot
            'participant_id',       // FK desta tabela na pivot
            'reuniao_id'            // FK do modelo relacionado na pivot
        )->withPivot('presente')
         ->withTimestamps();
    }
}
