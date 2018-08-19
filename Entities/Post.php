<?php

namespace Son\Blog\Entities;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [];
    
    public function getAuthorAttribute() {
        return "Mauro Uberti";
    }
}
