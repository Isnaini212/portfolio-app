<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    protected $fillable = ['key', 'value'];

    /**
     * Get a setting value by key with fallback default.
     */
    public static function get(string $key, ?string $default = null): ?string
    {
        return Cache::remember("setting_{$key}", 3600, function () use ($key, $default) {
            $setting = static::where('key', $key)->first();
            return $setting ? $setting->value : $default;
        });
    }

    /**
     * Set a setting value by key.
     */
    public static function set(string $key, ?string $value): void
    {
        static::updateOrCreate(['key' => $key], ['value' => $value]);
        Cache::forget("setting_{$key}");
    }

    /**
     * Get multiple settings as associative array.
     */
    public static function getMany(array $keysWithDefaults): array
    {
        $result = [];
        foreach ($keysWithDefaults as $key => $default) {
            $result[$key] = static::get($key, $default);
        }
        return $result;
    }
}
