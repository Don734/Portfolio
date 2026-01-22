<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;
use Illuminate\Support\Facades\Log;

class SettingSeeder extends Seeder
{
    /**
     * Default values for settings
     */
    private array $defaultValues = [
        // General
        'site_title' => 'My Portfolio',
        'site_description' => 'Welcome to my professional portfolio',
        'site_url' => null, // Will use APP_URL from env

        // Contact
        'contact_email' => null, // Will use MAIL_FROM_ADDRESS from env
        'contact_phone' => '+7 (999) 999-99-99',
        'contact_address' => 'Russia, Moscow',
        'contact_working_hours' => '9:00 AM - 6:00 PM',

        // Social
        'social_github' => '',
        'social_linkedin' => '',
        'social_telegram' => '',
        'social_instagram' => '',
        'social_youtube' => '',
        'social_whatsapp' => '',

        // SEO
        'seo_keywords' => 'portfolio, web developer',
        'seo_author' => '',
    ];

    /**
     * Run the database seeds
     */
    public function run(): void
    {
        $config = config('site-settings');

        foreach ($config as $group => $settings) {
            foreach ($settings as $key => $definition) {
                $value = $this->getDefaultValue($key);

                // Update or create the setting
                Setting::updateOrCreate(
                    ['key' => $key],
                    [
                        'value' => $value,
                        'type' => $definition['type'],
                        'group' => $group,
                    ]
                );
            }
        }

        $this->command->info('✅ Settings seeded successfully!');
    }

    /**
     * Get default value for setting key
     */
    private function getDefaultValue(string $key): string
    {
        return match ($key) {
            'site_url' => env('APP_URL', 'http://localhost'),
            'contact_email' => env('MAIL_FROM_ADDRESS', 'contact@example.com'),
            default => $this->defaultValues[$key] ?? ''
        };
    }
}
