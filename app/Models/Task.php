<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'urgency',
        'estimated_hours',
        'status',
    ];

    /**
     * Relacionamento: tarefa pode ter vários usuários (atribuição).
     */
    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}