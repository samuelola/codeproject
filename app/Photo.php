<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    
    protected $fillable = ['file'] ;

    protected $uploads = '/images/';



    public function getFileAttribute($sam){

        return $this->uploads.$sam;
    }
}
