<?php

use App\Models\Setting;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $settings = Setting::all();

        foreach ($settings as $setting) {
            $val = $setting->value;
            if (empty($val)) {
                continue;
            }

            // Strip any IP or port from URL settings to keep them root-relative or canonical
            $clean = preg_replace('#https?://(72\.62\.176\.78|127\.0\.0\.1:8000|localhost:8000|localhost)#', '', $val);
            if ($clean !== $val) {
                $setting->value = $clean ?: '/';
                $setting->save();
            }
        }

        // Explicitly enforce canonical values for header & hero navigation
        Setting::set('header_cta_url', '/contact');
        Setting::set('hero_btn2_url', '/projects');
        Setting::set('website_url', 'https://structurflex.ae');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No down needed for sanitizing hardcoded server IPs
    }
};
