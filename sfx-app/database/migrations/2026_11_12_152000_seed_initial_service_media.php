<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Al Ain Kindergartens
        $alAin = DB::table('services')->where('slug', 'al-ain-kindergartens')->first();
        if ($alAin && DB::table('service_media')->where('service_id', $alAin->id)->count() === 0) {
            $photos = [
                'Photo0591.jpg' => 'Canopy Tensile Formwork Overview',
                'Photo0592.jpg' => 'Column Connection & Mast Detailing',
                'Photo0593.jpg' => 'Daylight Diffusion Under Fabric',
                'Photo0596.jpg' => 'Perimeter Cable Anchoring Assembly',
                'Photo0597.jpg' => 'Shade Matrix & Playground Integration',
                'Photo0599.jpg' => 'Full Courtyard Birdseye Perspective',
                'Photo0600.jpg' => 'Structural Mast Foundation Detail',
                'Photo0604.jpg' => 'Membrane Pre-tensioning Tension Rings',
                'Photo0605.jpg' => 'Completed Shading Installation',
            ];

            $order = 1;
            foreach ($photos as $file => $caption) {
                DB::table('service_media')->insert([
                    'service_id' => $alAin->id,
                    'media_type' => 'image',
                    'file_path' => "assets/images/solutions/al-ain-kindergartens/{$file}",
                    'caption' => $caption,
                    'sort_order' => $order++,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        // 2. Al Gharafa Beach Ball Court
        $alGharafa = DB::table('services')->where('slug', 'al-gharafa-beach-court')->first();
        if ($alGharafa && DB::table('service_media')->where('service_id', $alGharafa->id)->count() === 0) {
            $photos = [
                'DSC_0811.jpg' => 'Stadium Canopy Structural Steel Truss',
                'DSC_0813.jpg' => 'Fabric Tension Membrane Elevation',
                'DSC_0814.jpg' => 'Court Shading Coverage Angle',
                'DSC_0815.jpg' => 'Cable Stayed Perimeter Rigging',
                'DSC_0817.jpg' => 'Cantilevered Shade Mast Detail',
                'Picture1.png' => 'Full Court Panoramic View',
                'Picture2.png' => 'Underside Daylight Diffusion',
                'Picture3.png' => 'Architectural Boundary Profile',
            ];

            $order = 1;
            foreach ($photos as $file => $caption) {
                DB::table('service_media')->insert([
                    'service_id' => $alGharafa->id,
                    'media_type' => 'image',
                    'file_path' => "assets/images/solutions/al-gharafa/{$file}",
                    'caption' => $caption,
                    'sort_order' => $order++,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        // 3. Commercial, Retail & Atrium Daylighting
        $commercial = DB::table('services')->where('slug', 'commercial-atriums')->first();
        if ($commercial && DB::table('service_media')->where('service_id', $commercial->id)->count() === 0) {
            DB::table('service_media')->insert([
                [
                    'service_id' => $commercial->id,
                    'media_type' => 'video',
                    'file_path' => 'assets/videos/posts/kenya-etfe-atrium.mp4',
                    'external_url' => null,
                    'caption' => 'Two Rivers Mall ETFE Atrium Installation Reel',
                    'sort_order' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'service_id' => $commercial->id,
                    'media_type' => 'image',
                    'file_path' => 'assets/images/solutions/commercial.jpg',
                    'external_url' => null,
                    'caption' => 'High-Transmittance ETFE Skylight System',
                    'sort_order' => 2,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'service_id' => $commercial->id,
                    'media_type' => 'image',
                    'file_path' => 'assets/images/solutions/architectural.png',
                    'external_url' => null,
                    'caption' => 'Double-Curvature Freeform Envelope Profile',
                    'sort_order' => 3,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);
        }

        // 4. Architectural Tensile & ETFE Structures
        $archTensile = DB::table('services')->where('slug', 'architectural-tensile')->first();
        if ($archTensile && DB::table('service_media')->where('service_id', $archTensile->id)->count() === 0) {
            DB::table('service_media')->insert([
                [
                    'service_id' => $archTensile->id,
                    'media_type' => 'video',
                    'file_path' => 'assets/videos/posts/kenya-etfe-atrium.mp4',
                    'external_url' => null,
                    'caption' => 'ETFE Cushion Inflation & Lighting Reel',
                    'sort_order' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'service_id' => $archTensile->id,
                    'media_type' => 'image',
                    'file_path' => 'assets/images/solutions/architectural.png',
                    'external_url' => null,
                    'caption' => 'Architectural PTFE Tensile Membrane Detail',
                    'sort_order' => 2,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'service_id' => $archTensile->id,
                    'media_type' => 'image',
                    'file_path' => 'assets/images/solutions/al-ain-kindergartens/Photo0591.jpg',
                    'external_url' => null,
                    'caption' => 'Conical Tensile Canopy Formation',
                    'sort_order' => 3,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Safe to leave or truncate
    }
};
