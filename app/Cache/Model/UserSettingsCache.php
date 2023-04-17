<?php

namespace App\Cache\Model;

use App\Cache\BaseCache;

class UserSettingsCache extends BaseCache {

    public function getDetailsCacheKey($id) {
        return $this->getCacheBaseKey() . config('cache.key_prefix.user_setting_model') . "-user-settings-$id";
    }

}
