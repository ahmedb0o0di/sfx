<?php

use App\Models\Post;
use App\Models\Project;
use App\Models\ProjectCategory;
use App\Models\ProjectImage;
use App\Models\Service;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // -------------------------------------------------------------
        // 1. Force-repair technical_specs for ALL 9 solutions
        // -------------------------------------------------------------
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
        }

        // -------------------------------------------------------------
        // 2. Ensure video_path column exists in posts table
        // -------------------------------------------------------------
        if (!Schema::hasColumn('posts', 'video_path')) {
            Schema::table('posts', function (Blueprint $table) {
                $table->string('video_path')->nullable()->after('featured_image');
            });
        }

        // -------------------------------------------------------------
        // 3. Ensure Kenya ETFE Video Post exists and is published
        // -------------------------------------------------------------
        Post::updateOrCreate(
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

        // -------------------------------------------------------------
        // 4. Ensure Abu Dhabi Ladies Club project exists and is published
        // -------------------------------------------------------------
        $sportsCat = ProjectCategory::firstOrCreate(
            ['slug' => 'sports'],
            ['name' => 'Sports & Stadia', 'filter_tag' => 'sports', 'sort_order' => 2]
        );

        $adlcProject = Project::updateOrCreate(
            ['slug' => 'abu-dhabi-ladies-club'],
            [
                'category_id' => $sportsCat->id,
                'title' => 'Abu Dhabi Ladies Club Tensile Roofs',
                'location' => 'Abu Dhabi, UAE',
                'client_name' => 'Musanada / Abu Dhabi Sports Council (ADSC)',
                'covered_area' => '4,500 m²',
                'membrane_material' => 'High-Performance Architectural PVC / PVDF Membrane',
                'year_completed' => 2012,
                'short_description' => 'Extensive 4,500 m² multi-feature tensile membrane roofing structures engineered for the premier Abu Dhabi Ladies Club sports and leisure complex.',
                'full_overview' => "Commissioned under Abu Dhabi General Services Company (Musanada) for the Abu Dhabi Sports Council, the Abu Dhabi Ladies Club stands as a world-class sports, wellness, and recreational facility located on Al Khaleej Al Arabi Street in Abu Dhabi.\n\nStructurflex Middle East was contracted to deliver turnkey engineering, fabrication, and installation of over 4,500 m² of multi-feature tensile membrane roofs. The structures span across semi-Olympic outdoor training swimming pools, tennis and squash courts, central clubhouse entrance pavilions, and privacy-shielded recreation courtyards.\n\nEngineered to withstand extreme Arabian Gulf summer temperatures exceeding 50°C and aggressive coastal winds, the lightweight membrane envelopes combine high-opacity UV blockout, advanced thermal heat rejection, and column-free clear sightlines.",
                'structural_challenge' => 'Engineering high-tensile thermal shading across sprawling outdoor athletic pools and sports courts while guaranteeing absolute visual privacy, extreme solar heat deflection, and enduring resistance to corrosive coastal winds.',
                'engineering_solution' => 'Engineered and erected modular anticlastic hypar and conical tensile membrane roofing structures utilizing premium architectural PVC with high-opacity UV blockout, custom-profiled structural steel perimeter masts, and marine-grade 316 stainless steel cable rigging.',
                'thumbnail_image' => 'assets/images/projects/abu-dhabi-ladies-club/thumb.jpg',
                'is_featured' => true,
                'status' => 'published',
                'sort_order' => 4,
            ]
        );

        // Guarantee gallery images exist for Abu Dhabi Ladies Club
        if ($adlcProject && ProjectImage::where('project_id', $adlcProject->id)->count() === 0) {
            $galleryImages = [
                ['image_path' => 'assets/images/projects/abu-dhabi-ladies-club/adlc-1.jpg', 'caption' => 'Multi-Feature Architectural Tensile Roof Structures', 'sort_order' => 1],
                ['image_path' => 'assets/images/projects/abu-dhabi-ladies-club/adlc-2.jpg', 'caption' => 'High-Tensile Clear-Span Membrane Canopy', 'sort_order' => 2],
                ['image_path' => 'assets/images/projects/abu-dhabi-ladies-club/adlc-3.jpg', 'caption' => 'Under-Canopy Diffused Daylight & Structural Mast Detailing', 'sort_order' => 3],
                ['image_path' => 'assets/images/projects/abu-dhabi-ladies-club/adlc-4.jpg', 'caption' => 'Outdoor Sports & Courtyard Shading Integration', 'sort_order' => 4],
                ['image_path' => 'assets/images/projects/abu-dhabi-ladies-club/adlc-5.jpg', 'caption' => 'Perimeter Tension Cables and Stainless Steel Rigging', 'sort_order' => 5],
            ];
            foreach ($galleryImages as $img) {
                ProjectImage::create([
                    'project_id' => $adlcProject->id,
                    'image_path' => $img['image_path'],
                    'caption' => $img['caption'],
                    'sort_order' => $img['sort_order'],
                ]);
            }
        }
    }

    public function down(): void
    {
        // Safe no-op
    }
};

