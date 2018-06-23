<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = ['title', 'body'];
    protected $hidden = ['created_at', 'updated_at'];
}
