<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostImages extends Model
{
    protected $fillable = ['type', 'post_id', 'image'];
}
