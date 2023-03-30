<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{

    use SoftDeletes, HasRoles, HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'name',
        'email',
        'gender',
        'birth_date',
        'mobile',
        'password',
        'status',
        'image',
        'balance',
        'department_id',
        'user_id',

    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];


    public function getRoleIdAttribute()
    {
        return ($this->roles and (!empty($this->roles[0]))) ? $this->roles[0]->id : 0;
    }

    public function getImageAttribute($value)
    {
        return $value ? url('storage/' . $value) : url('dashboard/images/1.png');
    }

    static function statusList($status = "")
    {
        $array = [
            0 => __('Awaiting review'),
            1 => __('Accepted'),
            2 => __('Disabled'),
        ];

        if ($status === false) {
            return $array;
        }

        if (!is_string($status) and $status != false or $status >= 0) {
            return !empty($array[$status]) ? $array[$status] : $status;
        }

        return $array;
    }

}
