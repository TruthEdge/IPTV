<?php

namespace App\Cache;

use Illuminate\Support\Facades\Cache;

abstract class BaseCache
{
  protected function setDataInCache($key, $data, $seconds = 15768000)
  {
    return Cache::put($key, $data, $seconds);
  }

  protected function getDatafromCache($key)
  {
    return Cache::get($key);
  }

  protected function deleteDataFromCache($key)
  {
    return Cache::forget($key);
  }

  public function getDetails($id)
  {
    return $this->getDatafromCache($this->getDetailsCacheKey($id));
  }

  public function setDetails($id, $data, $seconds = 15768000)
  {
    return $this->setDataInCache($this->getDetailsCacheKey($id), $data, $seconds);
  }

  public function deleteDetails($id)
  {
    return $this->deleteDataFromCache($this->getDetailsCacheKey($id));
  }

  protected function getCacheBaseKey()
  {
    return config('cache.key_prefix.general_key_prefix');
  }

  abstract public function getDetailsCacheKey($id);
}
