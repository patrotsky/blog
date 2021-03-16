<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable=['url'];

    /* R E L A T I O N S H I P S*/
    public function imageable(){
        return $this->morphTo();
    }
}
