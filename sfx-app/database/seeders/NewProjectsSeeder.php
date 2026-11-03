<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\ProjectImage;
use Illuminate\Database\Seeder;

class NewProjectsSeeder extends Seeder
{
    public function run(): void
    {
        $projects = [
            [
                'slug' => 'childhood-development-centre-rak',
                'category_id' => 1, // Architectural ETFE/PTFE
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
                'category_id' => 2, // Sports & Stadia
                'title' => 'Abu Dhabi Shooting Club Tensile Roof',
                'location' => 'Abu Dhabi, UAE',
                'client_name' => 'Atkins / Armed Forces Officers\' Club',
                'covered_area' => '1,650 m²',
                'membrane_material' => 'PTFE – Fibertop C3028',
                'year_completed' => 2009,
                'short_description' => 'Iconic PTFE tensile membrane hospitality rooftops engineered for Abu Dhabi\'s premier commercial shooting facility.',
                'full_overview' => "The Abu Dhabi Shooting Club, located at a purpose-built extension of the prestigious Armed Forces Officers' Club, stands as the capital's premier commercial target range and hospitality hub.\n\nStructurflex was commissioned to engineer, fabricate, and install the tensile membrane roofs spanning the rooftop restaurants and outdoor lounges. Our design engineering team optimized the original architectural geometries to prevent water ponding while substantially decreasing required structural steel framing tonnage.",
                'structural_challenge' => 'Initial roof concepts exhibited significant potential water ponding risks and excessive steel weight that compromised structural efficiency.',
                'engineering_solution' => 'Structurflex re-engineered the membrane curvatures to achieve flawless rainwater runoff, reduced overall steel tonnage, and manufactured custom Fibertop C3028 PTFE membranes that withstand harsh desert sun and coastal humidity.',
                'thumbnail_image' => 'assets/images/projects/abu-dhabi-shooting-club/thumb.jpg',
                'is_featured' => true,
                'status' => 'published',
                'sort_order' => 2,
                'images' => [
                    ['image_path' => 'assets/images/projects/abu-dhabi-shooting-club/shooting-1.jpg', 'caption' => 'Rooftop Restaurant Tensile Canopy Overlooking Range'],
                    ['image_path' => 'assets/images/projects/abu-dhabi-shooting-club/shooting-2.jpg', 'caption' => 'Double-Curved PTFE Membrane Geometry'],
                    ['image_path' => 'assets/images/projects/abu-dhabi-shooting-club/shooting-3.jpg', 'caption' => 'Architectural Steel Framing and Mast Connection'],
                    ['image_path' => 'assets/images/projects/abu-dhabi-shooting-club/shooting-4.jpg', 'caption' => 'Perimeter Cable Tensioning Hardware'],
                    ['image_path' => 'assets/images/projects/abu-dhabi-shooting-club/shooting-5.jpg', 'caption' => 'Shaded Outdoor Hospitality Lounge Area'],
                    ['image_path' => 'assets/images/projects/abu-dhabi-shooting-club/shooting-6.jpg', 'caption' => 'Twilight Architectural Illumination'],
                ],
            ],
            [
                'slug' => 'al-ain-kindergartens',
                'category_id' => 1, // Architectural ETFE/PTFE
                'title' => 'Al Ain Educational Kindergartens',
                'location' => 'Al Ain, UAE',
                'client_name' => 'Parsons',
                'covered_area' => '6,000 m² (2,000 m² each)',
                'membrane_material' => 'PVC – Mehler FR1000 & FR700M',
                'year_completed' => 2009,
                'short_description' => 'Extensive all-weather courtyard tensile membrane canopies engineered across three educational kindergarten campuses in Al Ain.',
                'full_overview' => "Al Ain's desert climate frequently exceeds 50°C during summer months alongside severe sandstorms and sporadic Hajar mountain cloudbursts.\n\nTo provide children with safe, shielded outdoor play and exercise environments, Structurflex engineered, fabricated, and installed three high-performance 2,000 m² courtyard canopies across three separate schools in Al Ain. Operating within compact, sensitive school perimeters, our installation methodology mobilized mobile cranes stationed externally to hoist and secure the steel structures and membranes safely.",
                'structural_challenge' => 'Installing massive 2,000 m² steel frame canopy modules inside enclosed school courtyards with zero internal vehicle access.',
                'engineering_solution' => 'Formulated an innovative rigging methodology utilizing long-reach mobile cranes positioned outside perimeter walls, safely lifting and assembling all structural steel and Mehler FR1000/FR700M PVC membranes ahead of schedule.',
                'thumbnail_image' => 'assets/images/projects/al-ain-kindergartens/thumb.jpg',
                'is_featured' => true,
                'status' => 'published',
                'sort_order' => 3,
                'images' => [
                    ['image_path' => 'assets/images/projects/al-ain-kindergartens/al-ain-1.jpg', 'caption' => 'Covered School Courtyard Shading System'],
                    ['image_path' => 'assets/images/projects/al-ain-kindergartens/al-ain-2.jpg', 'caption' => 'Multi-Cone Tensile Membrane Canopy'],
                    ['image_path' => 'assets/images/projects/al-ain-kindergartens/al-ain-3.jpg', 'caption' => 'High-Level Mast and Cable Suspension'],
                    ['image_path' => 'assets/images/projects/al-ain-kindergartens/al-ain-4.jpg', 'caption' => 'Perimeter Beam and Fabric Clamping Detail'],
                    ['image_path' => 'assets/images/projects/al-ain-kindergartens/al-ain-5.jpg', 'caption' => 'All-Weather Recreational Play Area'],
                    ['image_path' => 'assets/images/projects/al-ain-kindergartens/al-ain-6.jpg', 'caption' => 'Daylight Filtration Through Mehler PVC'],
                    ['image_path' => 'assets/images/projects/al-ain-kindergartens/al-ain-7.jpg', 'caption' => 'Structural Steel Frame Anchor Point'],
                    ['image_path' => 'assets/images/projects/al-ain-kindergartens/al-ain-8.jpg', 'caption' => 'Full Span Kindergarten Canopy View'],
                    ['image_path' => 'assets/images/projects/al-ain-kindergartens/al-ain-9.jpg', 'caption' => 'Corner Connection and Tensioning Hardware'],
                ],
            ],
            [
                'slug' => 'desert-palm-polo-estate',
                'category_id' => 2, // Sports & Stadia
                'title' => 'Desert Palm Polo Estate Canopies',
                'location' => 'Dubai, UAE',
                'client_name' => 'Al Bawardi Group',
                'covered_area' => '750 m²',
                'membrane_material' => 'PVC – Mehler FR700M',
                'year_completed' => 2008,
                'short_description' => 'Avant-garde architectural covered walkway canopies complementing luxury boutique desert polo resort architecture.',
                'full_overview' => "Set amidst verdant polo grounds and date palms on the outskirts of Dubai, the Desert Palm Polo Estate epitomizes luxury Arabia infused with avant-garde architecture.\n\nWith ambient summer highs reaching 40°C+, shaded pedestrian circulation was essential to connect guest villas with the resort's clubhouse and pavilions. Structurflex engineered and installed sleek, sandstorm-resilient white PVC canopy walkways that frame the resort's frontal facade with sophisticated, floating horizontal silhouettes.",
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
                'category_id' => 1, // Architectural ETFE/PTFE
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
}

