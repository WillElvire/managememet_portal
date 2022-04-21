<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class batch extends Model
{
    use HasFactory;
    protected $fillable  = ['teller_id','date','department_id','archive_id','user_id'];

    public function User(){
        return $this->belongsTo('App\Models\User');
    }

    public function Department(){
        return $this->belongsTo('App\Models\department');
    }

    public function Archive(){
        return $this->belongsTo('App\Models\archive');
    }
}
