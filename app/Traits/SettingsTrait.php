<?php

namespace App\Traits;

use App\Models\Settings;

trait SettingsTrait
{
    public function generalSettings($setting)
    {
        $general_settings = Settings::first();

        return $general_settings->{$setting};
    }
}
