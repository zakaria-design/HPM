<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Hadir extends Model
{
      use HasFactory;

      protected $table = 'hadir';
        protected $fillable = [
            'user_id',
            'foto',
            'latitude',
            'longitude',
            'alamat',
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
