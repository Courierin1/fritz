<?php

namespace App\Traits;
use App\CompanySetting;

trait CompanySettingTrait {

    public function getKeyValue($key) {
        return CompanySetting::where('key', $key)->first();
    }

    

    public function setKeyValue($key, $value) {

        $response = CompanySetting::where('key', $key)
        ->update([
            'value' => $value
        ]);

        return $response;
    }
}
