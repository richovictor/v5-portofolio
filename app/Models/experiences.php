<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class experiences extends Model
{
    protected $fillable = ['position', 'agency', 'start_date', 'end_date', 'location', 'description', 'user_id'];

    public function images()
    {
        return $this->hasMany(PostImages::class, 'post_id')->where('type', 'experience');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
