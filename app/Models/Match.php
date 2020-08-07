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

    protected $appends = [
        "format_match_date",
        "format_created_at"

    ];
  

    public function getFormatCreatedAtAttribute()
    {
        return date("d-m-Y h:i A",strtotime($this->created_at));
    }
    public function getFormatMatchDateAttribute()
    {
        return date("d-m-Y",strtotime($this->match_date));
    }
    

    public function point()
    {
        return $this->hasMany(Point::class,"match_id","id");
    }

    public function firstTeam()
    {
        return $this->belongsTo(Team::class,"first_team_id","id");
        
    }
    public function secondTeam()
    {
        return $this->belongsTo(Team::class,"second_team_id","id");
        
    }

}
