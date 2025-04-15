<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profil extends Model
{
    protected $fillable = [
        'user_id', 
        'username', 
        'alamat', 
        'no_telp', 
        'instagram', 
        'twitter', 
        'foto'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
