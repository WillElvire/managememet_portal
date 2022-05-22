<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;
    protected $fillable = ['voteer_id', 'result'];

    public function Voteer(){
        return $this->belongsTo('App\Models\Voteer');
    }
}
