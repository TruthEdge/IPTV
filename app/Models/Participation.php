<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Participation extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'image',
        'duration',
        'price',
        'status',
    ];

    protected $hidden = ['deleted_at'];
    static function statusList($status = ""){
        $array =  [
            0 => __('InActive'),
            1 => __('Active'),
        ];

        if($status === false){
            return $array;
        }

        if(array_key_exists($status,$array)){
            return $array[$status];
        }

        return $array;
    }

    public function getImageAttribute($value)
    {
        if ($value) {
            return url('storage/' . $value);
        } else {
            return  url('dashboard/images/image1.png');
        }
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
