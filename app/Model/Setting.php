<?php
namespace Model;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    public $timestamps = true;

    protected $fillable = [
        'key',
        'value',
        'description'
    ];
    public static function get($key, $default = null)
    {
        $setting = self::where('key', $key)->first();
        return $setting ? $setting->value : $default;
    }

    public static function set($key, $value)
    {
        return self::updateOrCreate(
            ['key' => $key],
            ['value' => $value]
        );
    }
}