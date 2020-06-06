<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property varchar $ip ip
 * @property text $url url
 * @property varchar $iso_code iso code
 * @property varchar $country country
 * @property varchar $city city
 * @property varchar $state state
 * @property varchar $state_name state name
 * @property varchar $postal_code postal code
 * @property varchar $lat lat
 * @property varchar $lon lon
 * @property varchar $timezone timezone
 * @property varchar $continent continent
 * @property varchar $currency currency
 * @property timestamp $created_at created at
 * @property timestamp $updated_at updated at
 */
class Guest extends Model
{

    /**
     * Database table name
     */
    protected $table = 'guests';

    /**
     * Mass assignable columns
     */
    protected $fillable = ['ip',
        'url',
        'iso_code',
        'country',
        'city',
        'state',
        'state_name',
        'postal_code',
        'lat',
        'lon',
        'timezone',
        'continent',
        'currency'];

    /**
     * Date time columns.
     */
    protected $dates = [];

    public static function init()
    {
        $ip = geoip()->getClientIP();

        $data = geoip($ip)->toArray();
        $data['url'] = url()->full();

        Guest::query()
            ->create($data);
    }

    public static function thisDay($add = 0)
    {
        return Guest::query()
            ->select('ip')
            ->whereDay('created_at', now()->addDays($add));
    }

    public static function thisWeek($add = 0)
    {
        return Guest::query()
            ->select('ip')
            ->whereBetween('created_at', [
                    now()->startOfWeek()->addWeeks($add),
                    now()->endOfWeek()->addWeeks($add)
                ]
            );
    }

    public static function thisMonth($add = 0)
    {
        return Guest::query()
            ->select('ip')
            ->whereMonth('created_at', now()->addMonths($add));
    }

    public static function thisYear($add = 0)
    {
        return Guest::query()
            ->select('ip')
            ->whereYear('created_at', now()->addYears($add));
    }
}
