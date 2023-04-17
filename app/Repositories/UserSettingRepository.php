<?php

namespace App\Repositories;

use App\Cache\Model\UserSettingsCache;
use App\Common\CommonUtil;
use App\Models\UserSettings;

class UserSettingRepository
{

    const USER_SETTINGS_DATA_TYPE_TEXT = 'text'; // Text or String  // Default
    const USER_SETTINGS_DATA_TYPE_JSON = 'json';
    const USER_SETTINGS_DATA_TYPE_INT = 'int';
    const USER_SETTINGS_DATA_TYPE_DATE = 'date';
    const USER_SETTINGS_DATA_TYPE_DATE_TIME = 'date_time';

  const CACHE_USER_SETTINGS_USER = 'user';



    public static function manageUserSetting($data, $user_id, $setting_key)
    {
      if (!(isset($data['updated_by']))) {
        return null;
      }
      $cacheObj = new UserSettingsCache();
      $data_object = self::getUserSettingByKey($user_id, $setting_key);
      $columns = UserSettings::getTableColumns(UserSettings::getTableName());
      if (!$data_object) {
        $data_object = new UserSettings();
        $data_object->user_id = $user_id;
        $data_object->created_by = $data['updated_by'];
        $data_object->data_key = $setting_key;
      }
      foreach ($data as $key => $d) {
        if (in_array($key, $columns)) {
          $data_object->$key = $d;
        }
      }
      $data_object->data_value = CommonUtil::fetch($data, 'data_value', '');
      $data_object->save();

      $cacheObj->deleteDetails(self::CACHE_USER_SETTINGS_USER . $user_id);
      return $data_object;
    }

    public static function getUserSettingByKey($user_id, $key)
    {
      $userSettings = self::getUserSettingByUserId($user_id);
      return CommonUtil::fetch($userSettings, $key, null);
    }

    public static function getUserSettingValueByKey($user_id, $key, $defaultVal = null)
    {
      $userSettings = self::getUserSettingByUserId($user_id);
      $data = CommonUtil::fetch($userSettings, $key, null);
      return CommonUtil::fetch($data, 'data_value', $defaultVal);
    }

    public static function getUserIdBySettingKey($key)
    {
      $cacheObj = new UserSettingsCache();
      $data = $cacheObj->getDetails($key);
      if ($data) {
        return CommonUtil::fetch($data, 'user_id');
      }
      $data = UserSettings::getUserSettingByKey($key);

      $cacheObj->setDetails($key, $data);
      return CommonUtil::fetch($data, 'user_id');
    }

    public static function getUserSettingByUserId($user_id)
    {
      $cacheObj = new UserSettingsCache();
      $data = $cacheObj->getDetails(self::CACHE_USER_SETTINGS_USER . $user_id);
      if ($data) {
        return $data;
      }
      $data = UserSettings::getUserSettingByUserId($user_id);
      $ret = array();
      if ($data) {
        foreach ($data as $d) {
          $ret[$d->data_key] = $d;
        }
      }
      $cacheObj->setDetails(self::CACHE_USER_SETTINGS_USER . $user_id, $ret);
      return $ret;
    }
}
