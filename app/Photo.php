<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    const TABLE_NAME = 'photos';
    
    protected $fillable = [
        'name', 'image'
    ];
    
    public function user(){
        return $this->belongsTo('App\User');
    }
}
