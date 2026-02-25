<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceSetting extends Model
{
    use HasFactory;

    /**
     * Get the service that owns the service setting.
     */
    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    /**
     * Get the unit for the service setting.
     */
    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    /**
     * Get a setting value by service ID and name
     * Returns the raw value as string to preserve precision
     */
    public static function getSetting(int $serviceId, string $name): ?string
    {
        $setting = self::where('service_id', $serviceId)
            ->where('name', $name)
            ->where('active', true)
            ->first();

        if (!$setting) {
            return null;
        }

        return (string) $setting->getRawOriginal('value');
    }

    /**
     * Get a setting value by service ID and partial name match
     * Returns the raw value as string to preserve precision
     */
    public static function getSettingByPartialMatch(int $serviceId, string $partialName): ?string
    {
        $setting = self::where('service_id', $serviceId)
            ->where('name', 'like', '%' . $partialName . '%')
            ->where('active', true)
            ->first();

        if (!$setting) {
            return null;
        }

        return (string) $setting->getRawOriginal('value');
    }
}
