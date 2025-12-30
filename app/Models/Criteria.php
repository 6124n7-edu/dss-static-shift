<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Criteria extends Model
{
    // Tell Laravel to use 'criteria' table, not 'criterias'
    protected $table = 'criteria';
    
    // Allow mass assignment (optional but good practice)
    protected $fillable = ['code', 'name', 'type', 'weight'];
}
