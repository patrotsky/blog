<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name','slug'];

    /* R E L A T I O N S H I P S*/
    public function posts(){
        return $this->hasMany(Post::class);
    }

    /* M E T H O D S*/
    public function getRouteKeyName()
    {
        return "slug";
    }
}
