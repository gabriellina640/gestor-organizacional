<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'scheduled_at',
        'is_recurring',
    ];

    protected $casts = [
        'scheduled_at' => 'datetime',
        'is_recurring' => 'boolean',
    ];

    /**
     * Relacionamento: uma reunião pode ter muitos usuários participantes.
     */
    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('checked_in')->withTimestamps();
    }
}