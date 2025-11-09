<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sakit extends Model
{
     use HasFactory;
     protected $table = 'sakit';

    protected $fillable = [
        'user_id',
        'alasan_sakit',
        'foto_bukti',
        'waktu',
        'jam',
    ];

    protected $casts = [
    'created_at' => 'datetime',
    'updated_at' => 'datetime',
];


    public function user() {
        return $this->belongsTo(User::class);
    }
}
