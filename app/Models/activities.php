<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class activities extends Model
{
    protected $fillable = ['title', 'description', 'location', 'user_id'];

    public function images()
    {
        return $this->hasMany(PostImages::class, 'post_id')->where('type', 'activity');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
