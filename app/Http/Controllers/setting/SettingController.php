<?php

namespace App\Http\Controllers\setting;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::where('key', 'site_settings')->first();
        $values = json_decode($settings->value, true);
        $values['site_logo'] = $this->getMediaUrlById($values['site_logo'] ?? null);
        $values['review_image'] = $this->getMediaUrlsByIds($values['review']['review_image'] ?? []);

        return $this->responseData($values, "fetch setting data");
    }
}
