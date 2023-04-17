<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserSettings extends Model
{
    use HasFactory ,SoftDeletes;

    protected $fillable=[
        'user_id',
        'data_key',
        'data_value',
        'data_type',
        'updated_by',
        'created_by',
    ];

 public static function getUserSettingByUserId($user_id)
  {

    return self::where(array('user_id' => $user_id))->get();
  }

  public static function getUserSettingByKey($key)
  {

    return self::where(array('data_key' => $key))->first();
  }

  public static function getAllUsersSettingsByKey($key)
  {
    return self::where(array('data_key' => $key))->get();
  }

  public static function getAllUsersSettingsByvalue($value)
  {
    return self::where('data_value', $value)->get('user_id');
  }

  public function users(): BelongsTo
  {
      return $this->belongsTo(User::class,'user_id','id');
  }

}
