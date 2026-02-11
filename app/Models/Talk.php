<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Talk extends Model
{
    protected $fillable = [
        'minor_major_user_ids',
        'creator_user_id',
        'guest_user_id',
    ];
}
