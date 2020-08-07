<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
    protected $fillable= [
        "team_id",
        "match_id",
        "points"
    ];

    public function team()
    {
        return $this->belongsTo(Team::class,"team_id","id");
    }

    public function match()
    {
        return $this->belongsTo(Match::class,"match_id","id");
    }
}
