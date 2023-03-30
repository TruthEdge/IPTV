<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bouquet extends Model
{
    protected $connection = 'IPTV';
    protected $table = 'bouquets';

    public function price(){
        return $this->hasOne(Price::class);
    }
}

