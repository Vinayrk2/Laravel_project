<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class SiteSetting extends Model
{
    protected $fillable = [
        'site_name',
        'email',
        'phone_number_1',
        'phone_number_2',
        'bussiness_email',
        'currency_rate',
        'address',
        'airport',
        'email_app_password',
        'tax',
        'instagram',
        'youtube',
        'linkedin',
    ];

    // Cache key for site settings
    private static string $cacheKey = 'site_settings';

    /**
     * Get cached instance of site settings
     */
    public static function getCached()
    {
        return Cache::rememberForever(self::$cacheKey, function () {
            return self::getInstance();
        });
    }

    /**
     * Clear the site settings cache
     */
    public static function clearCache()
    {
        Cache::forget(self::$cacheKey);
    }

    protected static function boot()
    {
        parent::boot();

        // Clear cache when settings are updated
        static::saved(function () {
            self::clearCache();
        });

        static::deleted(function () {
            self::clearCache();
        });
    }

    /**
     * Get footer data for the site.
     *
     * @return array
     */
    public function getFooterData()
    {
        return [
            'location' => $this->address ,
            'airport' => $this->airport,
            'instagram' => $this->instagram,
            'youtube' => $this->youtube,
            'linkedin' => $this->linkedin,
        ];
    }

    /**
     * Get header data for the site.
     *
     * @return array
     */
    public function getHeaderData()
    {
        return [
            'site_name' => $this->site_name,
            'email' => $this->email,
            'phone_number' => $this->phone_number_1,
        ];
    }

    /**
     * Return all settings as an associative array.
     *
     * @return array
     */
    public function toArray()
    {
        return [
            'site_name' => $this->site_name,
            'email' => $this->email,
            'phone_number_1' => $this->phone_number_1,
            'phone_number_2' => $this->phone_number_2,
            'bussiness_email' => $this->bussiness_email,
            'currency_rate' => $this->currency_rate,
            'address' => $this->address,
            'airport' => $this->airport,
            'email_app_password' => $this->email_app_password,
            'tax' => $this->tax,
            'instagram' => $this->instagram,
            'youtube' => $this->youtube,
            'linkedin' => $this->linkedin,
        ];
    }

    /**
     * Get or create the singleton instance.
     *
     * @return SiteSetting
     */
    public static function getInstance()
    {
        return self::firstOrCreate(['id' => 1], [
            'site_name' => 'QFAvionics',
            'email' => 'info@qfavionics.com',
            'bussiness_email' => 'info@qfavionics.com',
            'currency_rate' => 0.72,
            'address' => 'QF Avionics Center Ltd Hangar #11 Airport Drive, Springbook, ABT4S 2E8 Canada',
            'airport' => 'Red Deer Regional Airport, CYQF, YQF',
            'email_app_password' => 'zochakahgfehnxdq',
            'tax' => 0.15,
        ]);
    }

    /**
     * Override the save method to enforce a singleton instance.
     *
     * @param array $options
     * @return bool
     */
    public function save(array $options = [])
    {
        $this->id = 1; // Enforce singleton by setting ID to 1
        return parent::save($options);
    }
}
