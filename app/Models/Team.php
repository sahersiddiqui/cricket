<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Team extends Model
{    
    use SoftDeletes;

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
