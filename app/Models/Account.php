<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    // protected $connection = 'IPTV';
    protected $table = 'users';
    public $timestamps = false;
    protected $casts = [
        'is_trial' => 'boolean',
    ];
}

