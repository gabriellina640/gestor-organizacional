<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'work_days_per_week',
        'work_hours_per_day',
    ];

    /**
     * Relacionamento: uma organização tem muitos usuários.
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }
}