<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class certificates extends Model
{
    protected $fillable = ['title', 'agency', 'location', 'description', 'user_id'];

    public function images()
    {
        return $this->hasMany(PostImages::class, 'post_id')->where('type', 'certificate');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
