<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Player extends Model
{
    use SoftDeletes;

    protected $fillable = [
        "team_id" ,
        "firstname",
        "lastname",
        "image_uri",
        "jersey_number",
        "matches",
        "runs",
        "country",
        "highest_score",
        "total_fifties",
        "total_hundreds",
    ];

    protected $appends = [
        "name",
        "format_created_at"

    ];
    public function getNameAttribute()
    {
        return ucwords($this->firstname." ". $this->lastname);
    }

    public function getFormatCreatedAtAttribute()
    {
        return date("d-m-Y h:i A",strtotime($this->created_at));
    }

    public function team()
    {
        # code...
        return $this->belongsTo(Team::class,'team_id','id');
    }
}
