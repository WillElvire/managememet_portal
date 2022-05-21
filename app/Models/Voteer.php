<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voteer extends Model
{
    use HasFactory;
    protected $fillable = ['name','department','image_url'];
}
