<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    protected $fillable = [
        "team_id" ,
        "firstname",
        "lastname",
        "image_uri",
        "jersey_number",
        "matches",
        "runs",
        "highest_score",
        "total_fifties",
        "total_hundreds",
    ];

    protected $appends = [
        "name"
    ];
    public function getFormatCreatedAtAttribute()
    {
        return ucwords($this->firstname." ". $this->lastname);
    }
}
