<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $table = 'users_photos';
    public $timestamps = false;
    
    protected $fillable = [
        'name', 'image'
    ];
}
