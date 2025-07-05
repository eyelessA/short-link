<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LinkUser extends Model
{
    protected $table = 'links_users';
    protected $fillable = ['link_id', 'user_id'];
}
