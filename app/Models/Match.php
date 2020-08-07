<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Match extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        "first_team_id" ,
        "second_team_id" ,
        "match_date" ,
        "result" ,
    ];

    public function point()
    {
        return $this->hasOne(Point::class,"match_id","id");
    }
}
