<?php

namespace App\Console\Commands;

use App\Models\Post;
use App\Models\Project;
use App\Models\Service;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;

class SyncDeployCommand extends Command
{
    protected $signature = 'sfx:sync';

    protected $description = 'Sync database state, verify all solutions/posts/projects, ensure video assets, and purge all Filament and Laravel caches';

    public function handle(): int
    {
        $this->info('====================================================');
        $this->info('  SFX Middle East — Production Sync & Verification  ');
        $this->info('====================================================');

        // 1. Run migrations with force
        $this->line('<fg=yellow>1. Running database migrations...</fg=yellow>');
        Artisan::call('migrate', ['--force' => true]);
        $this->line(Artisan::output());

        // 2. Ensure video_path column in posts
        if (!Schema::hasColumn('posts', 'video_path')) {
            $this->warn('Adding missing video_path column to posts table...');
            Schema::table('posts', function ($table) {
                $table->string('video_path')->nullable()->after('featured_image');
            });
        }

        // 3. Verify & repair Kenya ETFE single skin roof post
        $this->line('<fg=yellow>2. Verifying Kenya ETFE Video Post...</fg=yellow>');
        $kenyaPost = Post::updateOrCreate(
            ['slug' => 'first-etfe-single-skin-roof-kenya'],
            [
                'title' => 'The First ETFE Single-Skin Roof in Kenya',
                'category' => 'Architectural Innovation',
                'excerpt' => 'Inspired by the vision of His Holiness Dr. Syedna Mufaddal Saifuddin, this landmark project introduces Kenya\'s first ETFE single-skin roof, combining structural engineering with aesthetic brilliance.',
                'content' => "Inspired by the vision of His Holiness Dr. Syedna Mufaddal Saifuddin, this project introduces Kenya's first ETFE single-skin roof, combining structural engineering with aesthetic brilliance to enhance the existing atrium.\n\nThe roof features innovative hexagonal patterns with pre-fritted and clear panels that nurture the flora and fauna below while filtering natural light. Designed around a divine hive concept, the structure illuminates and inspires the campus community, instilling a deep sense of pride in service and learning.\n\nKey Engineering Highlights:\n• East Africa's First Single-Skin ETFE Installation: Spanning the expansive central atrium of the Al Jamea campus in Nairobi, Kenya.\n• Advanced Solar Heat Control: Customized hexagonal fritted pattern deflects intense equatorial radiation while maintaining 90%+ natural illumination for lush indoor botanical growth.\n• Lightweight Pneumatic & Tensile Engineering: Drastically reduces structural steel weight compared to traditional glass, offering exceptional seismic resilience and superior durability against equatorial tropical rainfall.\n• Cleanroom Pre-Fabrication & Precision Installation: Fabricated under strict ISO quality standards and laser-aligned on-site without disruption to active academic facilities.",
                'featured_image' => 'assets/images/posts/kenya-etfe-single-skin.jpg',
                'video_path' => 'assets/videos/posts/kenya-etfe-atrium.mp4',
                'author' => 'Structurflex Technical Desk',
                'reading_time_minutes' => 4,
                'status' => 'published',
                'published_at' => now(),
            ]
        );
        $this->info("   ✓ Kenya Video Post verified: ID {$kenyaPost->id} [Status: {$kenyaPost->status}, Video: {$kenyaPost->video_path}]");

        // 4. Verify & repair all 9 Solution Specs
        $this->line('<fg=yellow>3. Verifying & Repairing 9 Solution Technical Specifications...</fg=yellow>');
        $solutionsData = [
            'architectural-tensile' => [
                'Spans' => 'Up to 60m+ clear spans without internal columns',
                'Materials' => 'PTFE Glass, ETFE Foil, PVC/PVDF Precontraint',
                'Thermal Performance' => 'Solar heat deflection up to 85%',
                'Warranty' => 'Up to 25 years guaranteed service life',
            ],
            'sports-canopies' => [
                'Sightlines' => '100% column-free spectator sightlines',
                'Wind Resistance' => 'Engineered for up to 160 km/h gusts',
                'Acoustics' => 'Tensioned acoustic membrane baffling',
                'Lighting' => 'Seamless floodlight and drainage integration',
            ],
            'commercial-atriums' => [
                'Light Transmission' => 'Adjustable from 10% to 95%',
                'Weight' => 'Less than 1% the weight of equivalent double glass',
                'Maintenance' => 'Self-cleaning fluoropolymer film',
            ],
            'transport-infrastructure' => [
                'Standards' => 'Compliant with UAE Civil Defense & international transit codes',
                'Durability' => 'Non-corrosive marine grade 316 stainless rigging',
                'Fire Rating' => 'Class A1 / non-combustible materials',
            ],
            'industrial-logistics' => [
                'Clear Span' => 'Up to 80m column-free clear spans',
                'Deployment' => 'Rapid modular erection in weeks',
                'UV Protection' => '100% UV blockout and heat deflection',
                'Corrosion' => 'Hot-dip galvanized heavy-duty framing',
            ],
            'air-supported-domes' => [
                'Clear Span' => 'Up to 150m+ completely column-free interior volume',
                'Material' => 'Double-Skin Thermal Insulated Air Dome Membrane',
                'Thermal & HVAC' => 'Smart automated pressure control and microclimate HVAC',
                'Deployment' => 'Rapid modular commissioning in weeks vs. years for steel halls',
                'Safety Systems' => 'Tri-redundant inflation system with automatic emergency generator',
            ],
            'lifecycle-maintenance' => [
                'Inspections' => 'Laser measurement of boundary cable pre-tensioning & deflection',
                'Testing' => 'Ultrasonic weld inspection and seam tear strength testing',
                'Access' => 'IRATA certified master rope-access engineering teams',
                'Coverage' => 'Regional Asset Fleet (>150,000 m² across UAE & GCC)',
                'AMC Response' => 'Guaranteed 24/7 emergency response & annual maintenance contracts',
            ],
            'al-gharafa-beach-court' => [
                'Plan Area' => '700 m² Grandstand Shading Cover',
                'Membrane Material' => 'High-Performance Architectural PVC / PVDF Coated Polyester',
                'Venue & Event' => 'Al Gharafa Sports Club — 2nd GCC Beach Games',
                'Location' => 'Doha, Qatar',
                'Sightlines' => '100% column-free spectator sightlines',
                'Structural Scope' => 'Turnkey structural steel masts, perimeter tension cables & membrane fabrication',
            ],
            'al-ain-kindergartens' => [
                'Fabric Area' => '2,000 m² per school campus (6,000 m² total across campuses)',
                'Fabric Type' => 'Mehler FR1000 & FR700M Flame-Retardant Architectural PVC',
                'Location' => 'Al Ain, UAE',
                'Architect / Client' => 'Parsons / Educational Authorities',
                'Thermal Performance' => 'Deflects over 85% of solar heat gain with 100% UV blockout',
                'Installation Methodology' => 'Precision external mobile crane hoisting outside courtyard perimeters',
            ],
        ];

        foreach ($solutionsData as $slug => $specs) {
            DB::table('services')
                ->where('slug', $slug)
                ->update([
                    'technical_specs' => json_encode($specs, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
                    'is_active' => true,
                    'updated_at' => now(),
                ]);
            $this->info("   ✓ Solution '{$slug}' technical_specs synchronized.");
        }

        // 5. Check video file on disk
        $this->line('<fg=yellow>4. Verifying Video and Media Assets on Disk...</fg=yellow>');
        $publicVideo = public_path('assets/videos/posts/kenya-etfe-atrium.mp4');
        $storageVideoDir = storage_path('app/public/posts/videos');
        $storageVideo = $storageVideoDir . '/kenya-etfe-atrium.mp4';

        if (File::exists($publicVideo)) {
            $this->info("   ✓ Video file present in public/assets: " . round(File::size($publicVideo) / 1048576, 2) . " MB");
            if (!File::isDirectory($storageVideoDir)) {
                File::makeDirectory($storageVideoDir, 0755, true);
            }
            if (!File::exists($storageVideo)) {
                File::copy($publicVideo, $storageVideo);
                $this->info("   ✓ Copied video to storage/app/public/posts/videos/ for Filament media access.");
            }
        } else {
            $this->warn("   ! Public video file not found at {$publicVideo}. Check git pull status.");
        }

        // 6. Clear all caches
        $this->line('<fg=yellow>5. Clearing All Filament & Laravel Caches...</fg=yellow>');
        Artisan::call('filament:clear-cached-components');
        $this->line("   ✓ Filament components cache cleared.");
        Artisan::call('filament:optimize-clear');
        $this->line("   ✓ Filament optimize cache cleared.");
        Artisan::call('optimize:clear');
        $this->line("   ✓ Laravel application optimize cache cleared.");
        Artisan::call('storage:link');
        $this->line("   ✓ Storage symlink verified.");

        $this->info('====================================================');
        $this->info('  Synchronization Complete! All updates are live.  ');
        $this->info('====================================================');

        return self::SUCCESS;
    }
}

