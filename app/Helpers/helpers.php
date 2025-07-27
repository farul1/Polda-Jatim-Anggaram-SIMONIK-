<?php
use App\Models\Setting;

function get_setting($key) {
    $setting = Setting::find($key);
    return $setting ? $setting->value : null;
}
