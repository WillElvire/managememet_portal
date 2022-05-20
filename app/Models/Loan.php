<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    protected $fillable = ['img','max','min','min_tenor','max_tenor','name','quotity','index'];
    use HasFactory;
}
