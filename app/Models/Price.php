<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Price extends Model
{
    protected $fillable = ['bouquet_id', 'value'];

    public function bouquet()
    {
        return $this->belongsTo(Bouquet::class);
    }
}

