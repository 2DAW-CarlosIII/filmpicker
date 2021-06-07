<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sala extends Model
{
    use HasFactory;

    public $incrementing = false;
    public $timestamps = false;
    protected $keyType = 'string';

    protected $casts = [
        'pool' => 'object',
        'matchs' => 'object',
        'aceptadas' => 'object'
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
