<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    // Allow mass assignment for scores
    protected $fillable = [
        'alternative_id', 
        'criteria_id', 
        'score'
    ];

    // Optional: Define relationships for easier access later
    public function alternative()
    {
        return $this->belongsTo(Alternative::class);
    }

    public function criteria()
    {
        return $this->belongsTo(Criteria::class);
    }
}