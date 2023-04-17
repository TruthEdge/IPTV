<?php

namespace App\Cache;

use App\Cache\BaseCache;

class GeneralCache extends BaseCache
{
    public const SETTING_MODEL_ALL = 'setting_model_all';
    // this class will have general cache functions for different models all data or dashboard stats etc
    public function getDetailsCacheKey($name)
    {
        return $this->getCacheBaseKey() . config('cache.key_prefix.general_settings') . "-general-settings-$name";
    }

    public function getSettingsCache()
    {
        return $this->getDetailsCacheKey(self::SETTING_MODEL_ALL);
    }

    public function getAllSettingsCache()
    {
        return $this->getDatafromCache($this->getSettingsCache());
    }
}
