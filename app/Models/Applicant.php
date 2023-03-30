<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Applicant extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'participation_id',
        'duration',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    static function durationList($duration = "")
    {
        $array = [
            1 => __('Days'),
            2 => __('Month'),
            3 => __('years'),
        ];

        if ($duration == "") {
            return $array;
        } else {
            return !empty($array[$duration]) ? $array[$duration] : $duration;
        }
    }
}
