<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LinkUser extends Model
{
    protected $table = 'links_users';
    protected $fillable = ['link_id', 'user_id'];

    public function link(): BelongsTo
    {
        return $this->belongsTo(Link::class);
    }
}
