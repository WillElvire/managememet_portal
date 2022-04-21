<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class archive extends Model
{
    use HasFactory;

    public function Batch(){
        return $this->hasMany('App\Models\batch');
    }

}
