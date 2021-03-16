<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = ['name','slug','color'];

    /* R E L A T I O N S H I P S*/
    public function posts(){
        return $this->belongsToMany(Post::class);
    }

    /* M E T H O D S*/
    public function getRouteKeyName()
    {
        return "slug";
    }
}
