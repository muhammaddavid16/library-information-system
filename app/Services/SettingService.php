<?php

namespace App\Services;

use App\Contracts\SettingContract;
use App\Models\FineSetting;

class SettingService implements SettingContract
{
    public function getFineSetting(): FineSetting
    {
        return FineSetting::firstOrFail();
    }

    public function setFineSetting(array $data): FineSetting
    {
        $fineSetting = FineSetting::firstOrFail();
        $fineSetting->update($data);

        return $fineSetting;
    }
}
