<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = [
        "name" ,
        "club_state",
        "logo_uri"
    ];

    protected $appends = [
        "format_created_at"
    ];
    public function getFormatCreatedAtAttribute()
    {
        return date("d-m-Y h:i A",strtotime($this->created_at));
    }
}
