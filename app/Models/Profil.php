<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profil extends Model
{
    protected $fillable = [
        'user_id',
        'username',
        'no_telp',
        'instagram',
        'link_instagram',
        'twitter',
        'link_twitter',
        'facebook',
        'link_facebook',
        'profile_image',
        'cover_image'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function profil()
    {
        return $this->hasOne(Profil::class);
    }

}
