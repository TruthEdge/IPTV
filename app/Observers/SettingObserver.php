<?php

namespace App\Observers;

use App\Cache\Model\SettingCache;
use App\Models\Setting;

class SettingObserver
{

    protected $cacheObj;

    public function __construct(SettingCache $cache)
    {
        $this->cacheObj = $cache;
    }

    /**
     * Handle the Setting "created" event.
     *
     * @param  \App\Models\Setting  $setting
     * @return void
     */
    public function created(Setting $setting)
    {
        //
        $this->cacheObj->setDetails($setting->id,$setting);

    }

    /**
     * Handle the Setting "updated" event.
     *
     * @param  \App\Models\Setting  $setting
     * @return void
     */
    public function updated(Setting $setting)
    {
        //
        $this->cacheObj->setDetails($setting->id,$setting);

    }

    /**
     * Handle the Setting "deleted" event.
     *
     * @param  \App\Models\Setting  $setting
     * @return void
     */
    public function deleted(Setting $setting)
    {
        //
        $this->cacheObj->deleteDetails($setting->id);

    }

    /**
     * Handle the Setting "restored" event.
     *
     * @param  \App\Models\Setting  $setting
     * @return void
     */
    public function restored(Setting $setting)
    {
        //
    }

    /**
     * Handle the Setting "force deleted" event.
     *
     * @param  \App\Models\Setting  $setting
     * @return void
     */
    public function forceDeleted(Setting $setting)
    {
        //
    }
}
