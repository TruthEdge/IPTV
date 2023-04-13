<?php

namespace App\Cache\Model;

use App\Cache\BaseCache;

class UserCache extends BaseCache {

    public function getDetailsCacheKey($id) {
        return $this->getCacheBaseKey() . config('cache.key_prefix.user_model') . "-users-$id";
    }

}
