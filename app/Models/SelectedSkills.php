<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SelectedSkills extends Model
{
    protected $fillable = ['skills', 'user_id'];

    public function user()
    {
        return $this->hasOne(User::class);
    }
}


