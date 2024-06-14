<?php

namespace App\Helpers;

use App\Models\City;
use App\Models\State;
use Illuminate\Support\Facades\Cache;

class CacheHelper
{
    public static function state()
    {
        if (!Cache::has('state_cache')) {
            $regions = State::where('country_id', 101)->get();
            Cache::put('state_cache', $regions);
        }
        return Cache::get('state_cache');
    }

    public static function city($state_id)
    {
        if (!Cache::has('city_cache_' . $state_id)) {
            $cities = City::where('state_id', $state_id)->get();
            Cache::put('city_cache_' . $state_id, $cities);
        }
        return Cache::get('city_cache_' . $state_id);
    }
}
