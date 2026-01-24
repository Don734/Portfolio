<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateSettingRequest;
use App\Models\Setting;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Ramsey\Collection\Set;

class SettingController extends Controller
{
    public function edit(): View
    {
        $settings = Setting::all()->groupBy('group');

        $grouped = [];
        foreach ($settings as $group => $items) {
            $grouped[$group] = $items->keyBy('key');
        }
        return view('admin.pages.settings.list', [
            'settings' => $grouped,
            'config' => config('site-settings')
        ]);
    }

    public function update(UpdateSettingRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $config = config('site-settings');

        foreach ($validated as $group => $settings) {
            if (is_array($settings)) {
                foreach ($settings as $key => $value) {
                    $type = $config[$group][$key]['type'] ?? 'string';
                    $processedValue = $this->processValue($value, $type);

                    Setting::updateOrCreate(
                        ['key' => $key],
                        [
                            'value' => $processedValue,
                            'type' => $type,
                            'group' => $group
                        ]
                    );
                }
            }
        }

        $this->clearSettingsCache();

        return redirect()
            ->route('admin.settings.edit')
            ->with('success', 'Settings updated successfully.');
    }

    public static function get(string $key, $default = null)
    {
        return Cache::remember("site_setting_{$key}", 3600, function () use ($key, $default) {
            $setting = Setting::where('key', $key)->first();
            return $setting?->value ?? $default;
        });
    }

    public static function getByGroup(string $group): array
    {
        return Cache::remember("settings_group_{$group}", 3600, function () use ($group) {
            return Setting::where('group', $group)
                ->pluck('value', 'key')
                ->toArray();
        });
    }

    private function processValue($value, string $type)
    {
        return match ($type) {
            'boolean' => $value ? '1' : '0',
            'integer' => (string) intval($value),
            'string' => (string) $value,
            'array', 'json' => is_array($value) ? json_encode($value) : $value,
            default => $value,
        };
    }

    private function clearSettingsCache(): void
    {
        $settings = Setting::all();
        foreach ($settings as $setting) {
            Cache::forget("site_setting_{$setting->key}");
        }

        Cache::forget("settings_group_general");
        Cache::forget("settings_group_contact");
        Cache::forget("settings_group_social");
        Cache::forget("settings_group_seo");
    }
}
