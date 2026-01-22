<?php

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;

/**
 * Generate localized route URL
 * 
 * @param string $name Route name
 * @param array $params Additional parameters
 * @param string|null $locale Locale (defaults to current)
 * @return string Generated URL
 */
function l_route($name, $parameters = [], $locale = null)
{
    $locale = $locale ?? app()->getLocale();
    if (!is_array($parameters)) {
        $parameters = [];
    }
    return route($name, array_merge(['locale' => $locale], $parameters));
}

/**
 * Generate dashboard route URL
 * 
 * @param string $name Route name
 * @param array $params Additional parameters
 * @return string Generated URL
 */
function dashboard_route(string $name, array $params = []): string
{
    return route($name, array_merge([
        'context' => config("app.context")
    ], $params));
}

/**
 * Secure date formatting
 * 
 * @param string|null $date Date
 * @param string $format Desired format
 * @return string|null Formatted date
 */
function getDefaultFormat(?string $date, string $format = 'Y-m-d H:i:s')
{
    if (empty($date)) {
        return null;
    }

    try {
        $carbonDate = Carbon::parse($date);
        return $carbonDate->format($format);
    } catch (\Exception $e) {
        return null;
    }
}

/**
 * Get setting value by key
 * 
 * Examples:
 * settings('site_title')
 * settings('contact_email', 'default@example.com')
 * 
 * @param string $key Setting key
 * @param mixed $default Default value
 * @return mixed Setting value
 */
function settings(string $key, $default = null)
{
    return Cache::remember("settings.{$key}", 60 * 60, function () use ($key, $default) {
        $setting = Setting::where('key', $key)->first();

        if (in_array($setting->type, ['json', 'array']) && $setting) {
            return json_decode($setting->value, true);
        }

        if ($setting->type === 'boolean') {
            return (bool) $setting->value;
        }
        
        return $setting ? $setting->value : $default;
    });
}

/**
 * Get social links
 * 
 * @return array Array of social links
 */
function socialLinks(): array
{
    return Cache::remember('social_links', 60 * 60, function () {
        return [
            'whatsapp' => settings('social_whatsapp', ''),
            'telegram' => settings('social_telegram', ''),
            'instagram' => settings('social_instagram', ''),
            'linkedin' => settings('social_linkedin', ''),
            'youtube' => settings('social_youtube', ''),
        ];
    });
}

/**
 * Get contact information
 * 
 * @return array Array of contact information
 */
function contactInfo(): array
{
    return Cache::remember('contact_info', 60 * 60, function () {
        return [
            'phone' => settings('contact_phone', ''),
            'email' => settings('contact_email', ''),
            'address' => settings('contact_address', ''),
            'working_hours' => settings('contact_working_hours', ''),
        ];
    });
}

/**
 * Get SEO data
 * 
 * @return array Array of SEO data
 */
function seoData(): array
{
    return Cache::remember('seo_data', 60 * 60, function () {
        return [
            'keywords' => settings('seo_keywords', ''),
            'author' => settings('seo_author', ''),
            'title' => settings('seo_title', ''),
            'description' => settings('seo_description', ''),
        ];
    });
}

/**
 * Format phone number
 * 
 * @param string $phone Phone number
 * @return string Formatted phone number
 */
function formatPhone(string $phone): string
{
    $cleaned = preg_replace('/\D/', '', $phone);

    if (strlen($cleaned) === 11) {
        return '+' . substr($cleaned, 0, 1) . ' (' . 
               substr($cleaned, 1, 3) . ') ' . 
               substr($cleaned, 4, 3) . '-' . 
               substr($cleaned, 7);
    }

    return $phone;
}

/**
 * Get setting value or throw exception if not found
 * For critical settings that must be present
 * 
 * @param string $key Setting key
 * @return mixed Setting value
 * @throws \Exception
 */
function requiredSetting(string $key)
{
    $value = settings($key);

    if ($value === null) {
        throw new \Exception("Required setting '{$key}' is not configured");
    }

    return $value;
}

/**
 * Clear settings cache (called after settings update)
 * 
 * @param string|null $key Specific setting or null for all
 * @return void
 */
function clearSettingsCache(?string $key = null): void
{
    if ($key) {
        Cache::forget("setting_{$key}");
    } else {
        // Clear all caches
        Cache::forget('social_links');
        Cache::forget('contact_info');
        Cache::forget('seo_data');

        // Clear individual caches
        $settings = Setting::all();
        foreach ($settings as $setting) {
            Cache::forget("setting_{$setting->key}");
        }
    }
}

/**
 * Check if setting exists
 * 
 * @param string $key Setting key
 * @return bool
 */
function hasSetting(string $key): bool
{
    return Setting::where('key', $key)->exists();
}

/**
 * Format bytes to human-readable string
 * 
 * @param int $bytes Size in bytes
 * @param int $precision Precision
 * @return string Formatted size
 */
function humanFileSize(int $bytes, int $precision = 2): string
{
    $units = ['B', 'KB', 'MB', 'GB', 'TB'];

    $bytes = max($bytes, 0);
    $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
    $pow = min($pow, count($units) - 1);
    $bytes /= (1 << (10 * $pow));

    return round($bytes, $precision) . ' ' . $units[$pow];
}

/**
 * Get initials from first and last name
 * 
 * @param string $firstName First name
 * @param string $lastName Last name
 * @return string Initials
 */
function getInitials(string $firstName, string $lastName): string
{
    return strtoupper(
        substr($firstName, 0, 1) . substr($lastName, 0, 1)
    );
}

/**
* Generate a URL for the current page with a different locale
*/
function changeLocaleUrl($locale): string
{
    $path = request()->path();
    $currentLocale = app()->getLocale();
        
    // Remove current locale from path if exists
    if (str_starts_with($path, $currentLocale . '/')) {
        $path = substr($path, strlen($currentLocale) + 1);
    } elseif ($path === $currentLocale) {
        $path = '';
    }
        
    return '/' . $locale . ($path ? '/' . $path : '');
}