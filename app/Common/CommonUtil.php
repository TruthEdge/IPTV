<?php

namespace App\Common;

use Carbon\Carbon;
use Exception;

class  CommonUtil
{
    const SECRET_KEY="IPTV&*^$%GCV^$#FBJ5124*&^%%$'";

    public static function hasDuplicates($array)
    {
        return count($array) !== count(array_unique($array));
    }

    public static function sanitizeNumber($number, $precision = 2)
    {
        try {
            if (is_numeric($number))
                return number_format($number, $precision);
            else {
                return $number;
            }
        } catch (Exception $e) {
            return $number;
        }
    }

    public static function getDifferenceBetweenTwoDates($date1, $date2 = null, $absolute = true): int
    {
        if (!$date2) {
            $date2 = Carbon::now();
        }
        $dat1Parsed = Carbon::parse($date1)->endOfDay();
        return $date2->diffInDays($dat1Parsed, $absolute);
    }

    public static function base64url_encode($data)
    {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }

    public static function base64url_decode($data)
    {
        return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT));
    }

    public static function encrypt($data, $secret_key =self::SECRET_KEY)
    {
        $str = json_encode($data);
        $result = '';
        for ($i = 0; $i < strlen($str); $i++) {
            $char = substr($str, $i, 1);
            $keychar = substr($secret_key, ($i % strlen($secret_key)) - 1, 1);
            $char = chr(ord($char) + ord($keychar));
            $result .= $char;
        }

        return self::base64url_encode($result);
    }

    public static function decrypt($str, $secret_key  = self::SECRET_KEY)
    {
        if (!$str) {
            return $str;
        }

        $str = self::base64url_decode($str);

        $result = '';
        for ($i = 0; $i < strlen($str); $i++) {
            $char = substr($str, $i, 1);
            $keychar = substr($secret_key, ($i % strlen($secret_key)) - 1, 1);
            $char = chr(ord($char) - ord($keychar));
            $result .= $char;
        }

        return json_decode($result, true);
    }
    public static function fetchFromObject(&$object, $keys, $defaultValue = null, $trim = false)
    {
      if (!$object) {
        return $defaultValue;
      }
      $v = $defaultValue;

      if (is_array($keys) && count($keys) > 0) {
        $ref = $object;
        $found = false;

        foreach ($keys as $key) {
          if (isset($ref->$key)) {
            $found = true;
            $ref = $ref->$key;
          } else {
            $found = false;
            break;
          }
        }

        if ($found) {
          $v = $ref;
        }
      } else {
        $key = $keys;
        $v = isset($object->$key) ? $object->$key : $defaultValue;
      }

      return $v !== null ? $trim ? trim($v) : $v : null;
    }

    public static function fetch(&$container, $keys, $defaultValue = null, $trim = false)
    {
      $v = $defaultValue;

      if (is_array($keys) && count($keys) > 0) {
        $ref = $container;
        $found = false;

        foreach ($keys as $key) {
          if (isset($ref[$key])) {
            $found = true;
            $ref = $ref[$key];
          } else {
            $found = false;
            break;
          }
        }

        if ($found) {
          $v = $ref;
        }
      } else {
        $key = $keys;
        $v = isset($container[$key]) ? $container[$key] : $defaultValue;
      }

      return $v !== null ? $trim ? trim($v) : $v : null;
    }

}
