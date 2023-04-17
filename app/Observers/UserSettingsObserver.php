<?php

namespace App\Observers;

use App\Cache\Model\UserSettingsCache;
use App\Models\UserSettings;

class UserSettingsObserver
{
    protected $cacheObj;

    public function __construct(UserSettingsCache $someDependency)
    {
        $this->cacheObj = $someDependency;
    }
    /**
     * Handle the UserSettings "created" event.
     *
     * @param  \App\Models\UserSettings  $userSettings
     * @return void
     */
    public function created(UserSettings $userSettings)
    {
        //
        $this->cacheObj->setDetails($userSettings->id,$userSettings);

    }

    /**
     * Handle the UserSettings "updated" event.
     *
     * @param  \App\Models\UserSettings  $userSettings
     * @return void
     */
    public function updated(UserSettings $userSettings)
    {
        //
        $this->cacheObj->setDetails($userSettings->id,$userSettings);

    }

    /**
     * Handle the UserSettings "deleted" event.
     *
     * @param  \App\Models\UserSettings  $userSettings
     * @return void
     */
    public function deleted(UserSettings $userSettings)
    {
        //
        $this->cacheObj->deleteDetails($userSettings->id);
    }

    /**
     * Handle the UserSettings "restored" event.
     *
     * @param  \App\Models\UserSettings  $userSettings
     * @return void
     */
    public function restored(UserSettings $userSettings)
    {
        //
    }

    /**
     * Handle the UserSettings "force deleted" event.
     *
     * @param  \App\Models\UserSettings  $userSettings
     * @return void
     */
    public function forceDeleted(UserSettings $userSettings)
    {
        //
    }
}
