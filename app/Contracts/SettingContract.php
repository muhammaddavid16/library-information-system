<?php

namespace App\Contracts;

use App\Models\FineSetting;

interface SettingContract
{
    public function getFineSetting(): FineSetting;
    public function setFineSetting(array $data): FineSetting;
}
