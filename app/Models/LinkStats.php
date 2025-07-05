<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LinkStats extends Model
{
    protected $fillable = ['link_id', 'ip_address', 'user_agent'];
}
