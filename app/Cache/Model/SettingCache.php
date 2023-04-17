<?php

namespace App\Cache\Model;

use App\Cache\BaseCache;

class SettingCache extends BaseCache {

    public function getDetailsCacheKey($id) {
        return $this->getCacheBaseKey() . config('cache.key_prefix.setting_model') . "-setting-$id";
    }

}
