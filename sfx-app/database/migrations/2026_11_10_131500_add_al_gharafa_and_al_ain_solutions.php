<?php

use App\Models\Service;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Al Gharafa Beach Ball Court
        Service::updateOrCreate(
            ['slug' => 'al-gharafa-beach-court'],
            [
                'title' => 'Al Gharafa Beach Ball Court',
                'subtitle' => 'Grandstand Shading for International Sports & Beach Games',
                'badge' => 'Sports & Arenas',
                'hero_image' => 'assets/images/solutions/al-gharafa.jpg',
                'icon_name' => 'sports-canopy',
                'summary' => 'Architectural PVC/PVDF tensile membrane roofs providing 700 m² of unobstructed spectator grandstand shading for international beach games and athletic facilities.',
                'description' => 'Engineered for the 2nd GCC Beach Games at Al Gharafa Sports Club in Doha, Qatar. Structurflex engineered, fabricated, and installed high-performance PVC/PVDF coated polyester tensile membrane roofs covering the 700 m² grandstand area. The sculptural canopies provide complete spectator shading, withstand harsh desert coastal winds, and maintain 100% column-free sightlines across volleyball, basketball, football, and handball courts.',
                'technical_specs' => [
                    'Plan Area' => '700 m² Grandstand Shading Cover',
                    'Membrane Material' => 'High-Performance Architectural PVC / PVDF Coated Polyester',
                    'Venue & Event' => 'Al Gharafa Sports Club — 2nd GCC Beach Games',
                    'Location' => 'Doha, Qatar',
                    'Sightlines' => '100% column-free spectator sightlines',
                    'Structural Scope' => 'Turnkey structural steel masts, perimeter tension cables & membrane fabrication',
                ],
                'sort_order' => 8,
                'is_active' => true,
            ]
        );

        // 2. Al Ain Educational Kindergartens
        Service::updateOrCreate(
            ['slug' => 'al-ain-kindergartens'],
            [
                'title' => 'Al Ain Educational Kindergartens',
                'subtitle' => 'All-Weather Courtyard Envelopes for Extreme Desert Climates',
                'badge' => 'Educational Campuses',
                'hero_image' => 'assets/images/solutions/al-ain-kindergartens.jpg',
                'icon_name' => 'arch-tensile',
                'summary' => 'High-performance PVC membrane courtyard canopies (2,000 m² per campus) engineered to provide safe, all-weather outdoor recreation for schools under extreme 50°C+ desert conditions.',
                'description' => 'Extensive all-weather educational canopy solutions engineered across multiple kindergarten campuses in Al Ain, UAE. Designed to withstand extreme desert heat exceeding 50°C, sporadic sandstorms, and mountain cloudbursts, Structurflex engineered, fabricated, and installed striking PVC membrane roofs (Mehler FR1000 & FR700M) covering 2,000 m² courtyards per school. Utilizing external mobile crane lifting methodologies within confined campus boundaries, these solutions provide safe, UV-shielded microclimates for children to play and learn year-round.',
                'technical_specs' => [
                    'Fabric Area' => '2,000 m² per school campus (6,000 m² total across campuses)',
                    'Fabric Type' => 'Mehler FR1000 & FR700M Flame-Retardant Architectural PVC',
                    'Location' => 'Al Ain, UAE',
                    'Architect / Client' => 'Parsons / Educational Authorities',
                    'Thermal Performance' => 'Deflects over 85% of solar heat gain with 100% UV blockout',
                    'Installation Methodology' => 'Precision external mobile crane hoisting outside courtyard perimeters',
                ],
                'sort_order' => 9,
                'is_active' => true,
            ]
        );
    }

    public function down(): void
    {
        Service::whereIn('slug', ['al-gharafa-beach-court', 'al-ain-kindergartens'])->delete();
    }
};
