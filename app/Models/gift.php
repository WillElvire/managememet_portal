<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class gift extends Model
{
    use HasFactory;
    protected $fillable = ['type_id','user_id','detail_id'];

    public function Detail(){
        return $this->belongsTo('App\Models\detail');
    }

    public function Type(){
        return $this->belongsTo('App\Models\type');
    }

    public function User(){
        return $this->belongsTo('App\Models\User');
    }
}
