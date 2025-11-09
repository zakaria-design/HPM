<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Absen extends Model
{
    
    use HasFactory;

protected $fillable = [
    'user_id',
    'foto',
    'latitude',
    'longitude',
    'alamat',
    'alasan_izin',
    'alasan_sakit',
    'foto_bukti',
    'waktu',
    'jam',
];


    public function user() {
        return $this->belongsTo(User::class);
    }
}
