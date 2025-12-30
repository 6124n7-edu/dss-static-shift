<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alternative extends Model
{
    // Allow Laravel to mass-assign these columns
    protected $fillable = [
        'name', 
        'description'
    ];
}
