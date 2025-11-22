<?php

use App\Models\SettingModel;

if (! function_exists('get_setting')) {
    function get_setting(string $key, $default = '')
    {
        static $cache = [];

        if (array_key_exists($key, $cache)) {
            return $cache[$key];
        }

        $model = new SettingModel();
        $value = $model->getValue($key, $default);

        $cache[$key] = $value;

        return $value;
    }
}
