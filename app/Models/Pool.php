<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pool extends Model
{
    use HasFactory;
    protected $fillable = ['voteer_id', 'user_id'];

    public function Voteer(){
        return $this->belongsTo('App\Models\Voteer');
    }
}
