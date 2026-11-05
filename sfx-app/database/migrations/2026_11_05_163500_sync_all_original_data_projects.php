<?php

use App\Models\Project;
use App\Models\ProjectCategory;
use App\Models\ProjectImage;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        // Ensure standard project categories exist
        $archCat = ProjectCategory::firstOrCreate(
            ['slug' => 'architectural'],
            ['name' => 'Architectural ETFE/PTFE', 'filter_tag' => 'architectural', 'sort_order' => 1]
        );

        $sportsCat = ProjectCategory::firstOrCreate(
            ['slug' => 'sports'],
            ['name' => 'Sports & Stadia', 'filter_tag' => 'sports', 'sort_order' => 2]
        );

        $projects = [
            [
                'slug' => 'childhood-development-centre-rak',
                'category_id' => $archCat->id,
                'title' => 'Childhood Development Centre Ras Al Khaimah',
                'location' => 'Ras Al Khaimah, UAE',
                'client_name' => 'Ministry of Community Development',
                'covered_area' => '1,200 m²',
                'membrane_material' => 'High-Performance Architectural PVC Membrane',
                'year_completed' => 2024,
                'short_description' => 'Turnkey replacement and structural revitalization of the central courtyard tensile membrane canopy for the Childhood Development Centre in Ras Al Khaimah.',
                'full_overview' => "The Childhood Development Centre in Ras Al Khaimah required a comprehensive replacement of its central courtyard tensile membrane roof. Over time, desert weathering and extreme temperature fluctuations necessitated a full structural refurbishment.\n\nStructurflex executed a seamless turnkey renovation journey: safely decommissioning the aged fabric, re-engineering perimeter cable attachments, and installing an advanced UV-resistant, thermally efficient architectural membrane that restores protected all-weather outdoor learning and recreation for the children.",
                'structural_challenge' => 'Safely removing and replacing an extensive courtyard canopy within an active educational facility without compromising the existing structural framework or daily operations.',
                'engineering_solution' => 'Engineered specialized modular tensioning rigging and upgraded cable boundaries with premium pre-tensioned architectural PVC, delivering superior solar heat rejection and extended lifecycle durability.',
                'thumbnail_image' => 'assets/images/projects/childhood-development-centre-rak/thumb.jpg',
                'is_featured' => true,
                'status' => 'published',
                'sort_order' => 1,
                'images' => [
                    ['image_path' => 'assets/images/projects/childhood-development-centre-rak/rak-1.jpg', 'caption' => 'Completed Courtyard Tensile Roof'],
                    ['image_path' => 'assets/images/projects/childhood-development-centre-rak/rak-2.jpg', 'caption' => 'Pre-Renovation Courtyard Assessment'],
                    ['image_path' => 'assets/images/projects/childhood-development-centre-rak/rak-3.jpg', 'caption' => 'Precision Membrane Replacement in Progress'],
                    ['image_path' => 'assets/images/projects/childhood-development-centre-rak/rak-4.jpg', 'caption' => 'Final Architectural Tensioning & Detailing'],
                ],
            ],
            [
                'slug' => 'abu-dhabi-shooting-club',
                'category_id' => $sportsCat->id,
                'title' => 'Abu Dhabi Shooting Club Tensile Roof',
                'location' => 'Abu Dhabi, UAE',
                'client_name' => 'Atkins / Armed Forces Officers\' Club',
                'covered_area' => '1,650 m²',
                'membrane_material' => 'PTFE – Fibertop C3028',
                'year_completed' => 2009,
                'short_description' => 'Iconic PTFE tensile membrane hospitality rooftops engineered for Abu Dhabi\'s premier commercial shooting facility.',
                'full_overview' => "The Abu Dhabi Shooting Club, located at a purpose-built extension of the prestigious Armed Forces Officers' Club, stands as the capital's premier commercial target range and hospitality hub.\n\nStructurflex was commissioned to engineer, fabricate, and install the tensile membrane roofs spanning the rooftop restaurants and outdoor lounges. Our design engineering team optimized the original architectural geometry into sleek hyperbolic paraboloid and conical shapes, eliminating ponding risks and resisting aggressive sand-laden coastal gusts.",
                'structural_challenge' => 'Complex irregular architectural profiles requiring precise non-linear form-finding to ensure zero water ponding and high wind resistance up to 160 km/h.',
                'engineering_solution' => 'Utilized premium Fibertop C3028 PTFE architectural fiberglass membrane with specialized laser-tensioned perimeter cables and marine-grade stainless hardware, yielding a 30+ year lifespan with self-cleaning capabilities.',
                'thumbnail_image' => 'assets/images/projects/abu-dhabi-shooting-club/thumb.jpg',
                'is_featured' => true,
                'status' => 'published',
                'sort_order' => 2,
                'images' => [
                    ['image_path' => 'assets/images/projects/abu-dhabi-shooting-club/shooting-1.jpg', 'caption' => 'Rooftop Lounge PTFE Tensile Canopies'],
                    ['image_path' => 'assets/images/projects/abu-dhabi-shooting-club/shooting-2.jpg', 'caption' => 'Aerodynamic Hyperbolic Paraboloid Roof Geometry'],
                    ['image_path' => 'assets/images/projects/abu-dhabi-shooting-club/shooting-3.jpg', 'caption' => 'Under-Canopy Lighting and Structural Cable Rigging'],
                    ['image_path' => 'assets/images/projects/abu-dhabi-shooting-club/shooting-4.jpg', 'caption' => 'Overview Across Armed Forces Officers Club Grounds'],
                    ['image_path' => 'assets/images/projects/abu-dhabi-shooting-club/shooting-5.jpg', 'caption' => 'Precision Tension Ring & Perimeter Mast Connections'],
                    ['image_path' => 'assets/images/projects/abu-dhabi-shooting-club/shooting-6.jpg', 'caption' => 'Sculptural Night Illumination of PTFE Fabric'],
                ],
            ],
            [
                'slug' => 'al-ain-kindergartens',
                'category_id' => $archCat->id,
                'title' => 'Al Ain Educational Kindergartens',
                'location' => 'Al Ain, UAE',
                'client_name' => 'Al Ain Educational Zone / Abu Dhabi Education Council',
                'covered_area' => '2,800 m² Across Multiple Campuses',
                'membrane_material' => 'Type II Architectural PVC/PVDF',
                'year_completed' => 2011,
                'short_description' => 'Multi-site educational canopy deployment delivering 100% UV protection and thermal cooling for school playgrounds in Al Ain.',
                'full_overview' => "As part of Abu Dhabi's progressive educational infrastructure modernisation programme, multiple kindergarten campuses across the Al Ain desert oasis required robust shading solutions for student play zones.\n\nStructurflex engineered, manufactured, and installed vibrant, aerodynamically contoured tensile canopy clusters that deflect over 85% of solar heat gain while blocking harmful UV radiation, creating safe, shaded microclimates for child recreation.",
                'structural_challenge' => 'Simultaneous fast-track execution across multiple active school campuses during summer recess with strict delivery handover milestones.',
                'engineering_solution' => 'Standardized prefabricated high-tensile membrane modules featuring sand-proof sealed cable pockets and impact-safe rounded column bases, installed across all campuses on schedule.',
                'thumbnail_image' => 'assets/images/projects/al-ain-kindergartens/thumb.jpg',
                'is_featured' => true,
                'status' => 'published',
                'sort_order' => 3,
                'images' => [
                    ['image_path' => 'assets/images/projects/al-ain-kindergartens/al-ain-1.jpg', 'caption' => 'Central Playground Conical Tensile Shading Cluster'],
                    ['image_path' => 'assets/images/projects/al-ain-kindergartens/al-ain-2.jpg', 'caption' => 'Vibrant Shaded Outdoor Activity Zone'],
                    ['image_path' => 'assets/images/projects/al-ain-kindergartens/al-ain-3.jpg', 'caption' => 'High-Strength Steel Supporting Columns and Rigging'],
                    ['image_path' => 'assets/images/projects/al-ain-kindergartens/al-ain-4.jpg', 'caption' => 'Wide-Angle Play Area Coverage'],
                    ['image_path' => 'assets/images/projects/al-ain-kindergartens/al-ain-5.jpg', 'caption' => 'Safe Play Environment Under Diffused Daylight'],
                    ['image_path' => 'assets/images/projects/al-ain-kindergartens/al-ain-6.jpg', 'caption' => 'Membrane Patterning and Corner Ring Detailing'],
                    ['image_path' => 'assets/images/projects/al-ain-kindergartens/al-ain-7.jpg', 'caption' => 'Perimeter Shading Structure Integration'],
                    ['image_path' => 'assets/images/projects/al-ain-kindergartens/al-ain-8.jpg', 'caption' => 'Multi-Point Cable Tension System'],
                    ['image_path' => 'assets/images/projects/al-ain-kindergartens/al-ain-9.jpg', 'caption' => 'Campus Play Courtyard Architecture'],
                ],
            ],
            [
                'slug' => 'desert-palm-polo-estate',
                'category_id' => $archCat->id,
                'title' => 'Desert Palm Polo Estate Canopies',
                'location' => 'Dubai, UAE',
                'client_name' => 'Desert Palm Resort & Polo Club',
                'covered_area' => '850 m²',
                'membrane_material' => 'PVC – Mehler FR700M',
                'year_completed' => 2008,
                'short_description' => 'Bespoke luxury cantilevered tensile walkways and estate arrival canopies for Dubai\'s premier polo resort.',
                'full_overview' => "Nestled within a 160-acre estate of championship polo grounds, Desert Palm is one of Dubai's most exclusive boutique luxury resorts.\n\nTo complement the resort's clean contemporary Arabian aesthetic, Structurflex designed and built custom cantilevered white PVC canopy walkways that frame the resort's frontal facade with sophisticated, floating horizontal silhouettes.",
                'structural_challenge' => 'Tight delivery timeframe requiring accelerated engineering and installation to meet the resort\'s grand opening deadline despite client schedule advancements.',
                'engineering_solution' => 'Mobilized 24/7 fabrication teams to manufacture precision Mehler FR700M membrane modules, deploying streamlined cantilevered steel frames that withstand extreme desert sand winds while preserving clean, minimalist sightlines.',
                'thumbnail_image' => 'assets/images/projects/desert-palm-polo-estate/thumb.jpg',
                'is_featured' => true,
                'status' => 'published',
                'sort_order' => 4,
                'images' => [
                    ['image_path' => 'assets/images/projects/desert-palm-polo-estate/desert-palm-1.jpg', 'caption' => 'Cantilevered Walkway Shading Along Resort Pathway'],
                    ['image_path' => 'assets/images/projects/desert-palm-polo-estate/desert-palm-2.jpg', 'caption' => 'Minimalist Tensile Canopy Profile'],
                    ['image_path' => 'assets/images/projects/desert-palm-polo-estate/desert-palm-3.jpg', 'caption' => 'Integration with Palm Landscaping and Villa Facade'],
                    ['image_path' => 'assets/images/projects/desert-palm-polo-estate/desert-palm-4.jpg', 'caption' => 'Under-Canopy Diffused Daylight'],
                    ['image_path' => 'assets/images/projects/desert-palm-polo-estate/desert-palm-5.jpg', 'caption' => 'Sleek Steel Support Geometry'],
                ],
            ],
            [
                'slug' => 'dubai-outlet-mall',
                'category_id' => $archCat->id,
                'title' => 'Dubai Outlet Mall Central Dome',
                'location' => 'Dubai, UAE',
                'client_name' => 'Al Ahli Holding Group',
                'covered_area' => '3,850 m²',
                'membrane_material' => 'PVC – Mehler FR1000M / Mehler FR900M',
                'year_completed' => 2007,
                'short_description' => 'Iconic 3,850 m² hemispherical central atrium tensile membrane roof engineered on an accelerated fast-track schedule.',
                'full_overview' => "Dubai Outlet Mall is the Middle East's premier outlet shopping destination, hosting over 1,200 world-renowned fashion brands. Its desert highway location exposes the structure to intense heat and sandstorms.\n\nFollowing an initial project hiatus, Structurflex was approached to deliver a brand-new, rapid-assembly dome roof under an extreme deadline countdown prior to tenant handovers and opening day. Structurflex engineered, patterned, fabricated, and installed the striking 3,850 m² hemispherical roof membrane, creating an unmistakable architectural beacon visible from afar.",
                'structural_challenge' => 'Accelerated turnaround: completing full engineering, pattern calculation, fabrication, and high-altitude installation of a 3,850 m² membrane within an exceptionally compressed timeframe.',
                'engineering_solution' => 'Coordinated client steel erection with parallel membrane patterning and ultrasonic welding, rapidly hoisting and tensioning the multi-radial Mehler membrane to deliver an iconic desert-proof atrium dome that became the mall\'s defining landmark.',
                'thumbnail_image' => 'assets/images/projects/dubai-outlet-mall/thumb.jpg',
                'is_featured' => true,
                'status' => 'published',
                'sort_order' => 5,
                'images' => [
                    ['image_path' => 'assets/images/projects/dubai-outlet-mall/outlet-mall-1.jpg', 'caption' => 'Iconic Hemispherical Central Atrium Dome'],
                    ['image_path' => 'assets/images/projects/dubai-outlet-mall/outlet-mall-2.jpg', 'caption' => 'Expansive 3,850 m² Radial Membrane Patterning'],
                    ['image_path' => 'assets/images/projects/dubai-outlet-mall/outlet-mall-3.jpg', 'caption' => 'Architectural Skyline Silhouette in Dubai'],
                ],
            ],
        ];

        foreach ($projects as $pData) {
            $images = $pData['images'];
            unset($pData['images']);

            $project = Project::updateOrCreate(
                ['slug' => $pData['slug']],
                $pData
            );

            // Re-seed gallery images
            ProjectImage::where('project_id', $project->id)->delete();
            foreach ($images as $order => $img) {
                ProjectImage::create([
                    'project_id' => $project->id,
                    'image_path' => $img['image_path'],
                    'caption' => $img['caption'],
                    'sort_order' => $order + 1,
                ]);
            }
        }
    }

    public function down(): void
    {
        // Safe no-op
    }
};
