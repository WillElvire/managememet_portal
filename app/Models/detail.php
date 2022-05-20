<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detail extends Model
{
    use HasFactory;

    protected $fillable = ['recepient_name','receiver_name','donor_name','gift_content','gift_element','comment','pourer_name','file_url','reception_date','reception_agency','amount'];

    public function Gift(){
        return $this->belongsTo('App\Models\gift');
    }
}
