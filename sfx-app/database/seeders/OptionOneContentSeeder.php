<?php

namespace Database\Seeders;

use App\Models\ContactInquiry;
use App\Models\EstimatorLead;
use App\Models\Material;
use App\Models\Post;
use App\Models\Project;
use App\Models\ProjectCategory;
use App\Models\ProjectImage;
use App\Models\Service;
use App\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class OptionOneContentSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Site Settings
        $settings = [
            'site_name' => 'Structurflex Middle East Contracting LLC',
            'site_tagline' => 'Pioneers in Tensile Membrane Architecture & Air Domes Since 1937',
            'hero_tag' => 'Official SFXMEC Regional Entity — UAE & Egypt',
            'hero_title' => 'Engineering Iconic Tensile Architecture Across the Middle East',
            'hero_subtitle' => 'Specialized EPC contracting in PTFE, ETFE, PVC membrane structures and ASATI air-supported domes for stadia, landmarks, and transit infrastructure.',
            
            // Dubai Regional Hub
            'dubai_office_title' => 'Dubai Regional Headquarters (UAE)',
            'dubai_address' => 'Office 103, Makateb Building, Port Saeed, Deira, P.O. Box 92837, Dubai, United Arab Emirates',
            'dubai_phone' => '+971 4 295 9942',
            'dubai_email' => 'dubai@structurflex.ae',
            
            // Cairo Regional Hub
            'cairo_office_title' => 'Cairo Regional Engineering Branch (Egypt)',
            'cairo_address' => 'Villa 18, Street 254, Degla, Maadi, Cairo, Egypt',
            'cairo_phone' => '+971 4 238 8499',
            'cairo_email' => 'cairo@structurflex.ae',
            
            'general_email' => 'info@structurflex.ae',
            'sales_email' => 'rfp@structurflex.ae',
            'careers_email' => 'careers@structurflex.ae',
            'whatsapp_number' => '+971502959942',
            'whatsapp_display' => '+971 50 295 9942',
            
            // Statistics Counters
            'stat_projects' => '9,000+',
            'stat_projects_label' => 'Global Completed Projects',
            'stat_experience' => '85+',
            'stat_experience_label' => 'Years Global Heritage (Since 1937)',
            'stat_mena_years' => '19+',
            'stat_mena_years_label' => 'Years Direct MENA Presence (Since 2005)',
            'stat_area' => '1.2M m²',
            'stat_area_label' => 'Fabric Membrane Installed',
            'stat_engineers' => '85+',
            'stat_engineers_label' => 'Certified Riggers & Engineers',
            
            'social_linkedin' => 'https://www.linkedin.com/company/structurflex-middle-east-contracting-l-l-c',
            'social_twitter' => 'https://twitter.com/structurflex',
            'social_instagram' => 'https://instagram.com/structurflex',
        ];

        foreach ($settings as $key => $value) {
            Setting::set($key, $value);
        }

        // 2. Project Categories
        $categories = [
            [
                'name' => 'Architectural ETFE/PTFE',
                'slug' => 'architectural',
                'filter_tag' => 'architectural',
                'sort_order' => 1,
            ],
            [
                'name' => 'Sports & Stadia',
                'slug' => 'sports',
                'filter_tag' => 'sports',
                'sort_order' => 2,
            ],
            [
                'name' => 'Air-Supported Domes',
                'slug' => 'air-supported',
                'filter_tag' => 'air-supported',
                'sort_order' => 3,
            ],
            [
                'name' => 'Infrastructure & Transit',
                'slug' => 'infrastructure',
                'filter_tag' => 'infrastructure',
                'sort_order' => 4,
            ],
        ];

        $categoryMap = [];
        foreach ($categories as $cat) {
            $created = ProjectCategory::updateOrCreate(['slug' => $cat['slug']], $cat);
            $categoryMap[$cat['slug']] = $created->id;
        }

        // 3. Materials Matrix
        $materials = [
            [
                'name' => 'PTFE Fiberglass',
                'code' => 'ptfe',
                'tensile_strength' => '7,000 / 6,000 N/5cm',
                'light_transmission' => '10% – 25% (Diffused Daylight)',
                'solar_heat_gain' => 'Low (Shading Coeff: 0.15)',
                'expected_lifespan' => '35+ Years',
                'fire_rating' => 'Class A1 / Non-Combustible (BS 476 Pt 7)',
                'self_cleaning' => 'TiO2 Photocatalytic Clean',
                'typical_applications' => 'Mega-stadia, grand architectural canopies, international airport terminals, high-wind exposed structures.',
                'sort_order' => 1,
            ],
            [
                'name' => 'ETFE Foil & Cushions',
                'code' => 'etfe',
                'tensile_strength' => '40 – 60 MPa (High Elasticity)',
                'light_transmission' => 'Up to 95% (Ultra-High Clarity)',
                'solar_heat_gain' => 'Adjustable via Frit Printing (0.20 – 0.75)',
                'expected_lifespan' => '50+ Years (Inert Fluoropolymer)',
                'fire_rating' => 'Class B-s1, d0 (Self-Extinguishing)',
                'self_cleaning' => 'Fluoropolymer Non-Stick Surface',
                'typical_applications' => 'Botanical domes, retail mall atriums, architectural skylights, acoustic building facades.',
                'sort_order' => 2,
            ],
            [
                'name' => 'PVC / PVDF Composite',
                'code' => 'pvc',
                'tensile_strength' => '4,500 / 4,000 N/5cm',
                'light_transmission' => '5% – 15% (Translucent / Blackout)',
                'solar_heat_gain' => 'Medium (Shading Coeff: 0.22)',
                'expected_lifespan' => '18 – 25 Years',
                'fire_rating' => 'Class B1 / DIN 4102-1 Flame-Retardant',
                'self_cleaning' => 'PVDF Top Lacquer Layer',
                'typical_applications' => 'Air-supported sports domes, car park shade structures, resort pavilions, temporary event venues.',
                'sort_order' => 3,
            ],
        ];

        foreach ($materials as $mat) {
            Material::updateOrCreate(['code' => $mat['code']], $mat);
        }

        // 4. Projects Portfolio (12 Authentic Executed Projects)
        $projects = [
            [
                'category_slug' => 'architectural',
                'slug' => 'al-jamea',
                'title' => 'Al Jamea Tus Saifiyah ETFE Roof Structure',
                'location' => 'Nairobi, Kenya (Eastern Africa)',
                'client_name' => 'Al Jamea Tus Saifiyah',
                'covered_area' => '4,800 m²',
                'membrane_material' => 'Single Skin ETFE Tensile Membrane',
                'year_completed' => 2022,
                'short_description' => 'Single Skin ETFE tensile membrane structure marrying cultural heritage with engineering precision.',
                'full_overview' => 'Transforming architectural concepts into reality at the heart of Nairobi, Kenya. Structurflex Middle East Contracting LLC engineered and installed an innovative Single Skin ETFE tensile membrane roofing structure that marries cultural heritage with modern engineering precision. The translucent membrane delivers exceptional daylighting while maintaining thermal comfort and weather durability in equatorial conditions.',
                'structural_challenge' => 'Accommodating complex 3D perimeter geometry with seamless integration onto curved structural steel arches while resisting heavy tropical wind and rainfall.',
                'engineering_solution' => 'Engineered a 34m unsupported curved extrusion system with custom laser-aligned edge clamps and high-frequency welded single-skin ETFE foils.',
                'thumbnail_image' => 'assets/images/projects/al-jamea-etfe.png',
                'is_featured' => true,
                'sort_order' => 1,
                'gallery' => [
                    'assets/images/projects/al-jamea-etfe.png',
                    'assets/images/projects/al-jamea-interior.png',
                    'assets/images/solutions/architectural.png',
                ],
            ],
            [
                'category_slug' => 'architectural',
                'slug' => 'al-janah',
                'title' => 'The Al Janah Landmark Pavilion',
                'location' => 'Dubai, United Arab Emirates',
                'client_name' => 'Landmark Expo Pavilion Authority',
                'covered_area' => '6,200 m²',
                'membrane_material' => 'Architectural PTFE & Custom Steel Truss',
                'year_completed' => 2021,
                'short_description' => 'Crucial engineering and fabrication role in bringing this breathtaking sculptural design into reality.',
                'full_overview' => 'Structurflex Middle East Contracting LLC played a crucial role in bringing this breathtaking design concept into reality. Featuring sculptural tensile geometry with dual curvature, this pavilion stands as a symbol of architectural elegance and engineering excellence across the Expo precinct.',
                'structural_challenge' => '42-meter cantilevered wing architecture requiring hyper-precise non-linear stress analysis to prevent flutter under desert gusts.',
                'engineering_solution' => 'Bespoke bi-axial prestressing rig with high-strength stainless steel catenary cables and Grade-1 architectural PTFE membrane.',
                'thumbnail_image' => 'assets/images/projects/al-janah-pavilion.png',
                'is_featured' => true,
                'sort_order' => 2,
                'gallery' => [
                    'assets/images/projects/al-janah-pavilion.png',
                    'assets/images/solutions/architectural.png',
                    'assets/images/projects/al-ain-kindergartens.jpg',
                ],
            ],
            [
                'category_slug' => 'architectural',
                'slug' => 'ethiopia',
                'title' => 'Ethiopia Pavilion — Unity Park',
                'location' => 'Addis Ababa, Ethiopia',
                'client_name' => 'Oromia Regional Government',
                'covered_area' => '3,900 m²',
                'membrane_material' => 'High-Tensile PVC/PVDF Architectural Membrane',
                'year_completed' => 2019,
                'short_description' => 'Seamlessly integrated with historic Unity Park under contract with Oromia Regional Government.',
                'full_overview' => 'A breathtaking pavilion seamlessly integrated into the historic Unity Park in Addis Ababa. Structurflex Middle East executed the full engineering, fabrication, and on-site installation, delivering solar protection and an iconic civic landmark for visitors and state events.',
                'structural_challenge' => 'Integrating lightweight membrane foundations with sensitive archaeological soil substrates in an active heritage reserve.',
                'engineering_solution' => 'Self-balancing mast and tie-back cable network minimizing ground reactions and allowing accelerated modular erection.',
                'thumbnail_image' => 'assets/images/projects/ethiopia-unity-park.jpg',
                'is_featured' => true,
                'sort_order' => 3,
                'gallery' => [
                    'assets/images/projects/ethiopia-unity-park.jpg',
                    'assets/images/projects/al-jamea-etfe.png',
                ],
            ],
            [
                'category_slug' => 'sports',
                'slug' => 'abu-dhabi-shooting-club',
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
                'gallery' => [
                    'assets/images/projects/abu-dhabi-shooting-club/shooting-1.jpg',
                    'assets/images/projects/abu-dhabi-shooting-club/shooting-2.jpg',
                    'assets/images/projects/abu-dhabi-shooting-club/shooting-3.jpg',
                    'assets/images/projects/abu-dhabi-shooting-club/shooting-4.jpg',
                    'assets/images/projects/abu-dhabi-shooting-club/shooting-5.jpg',
                    'assets/images/projects/abu-dhabi-shooting-club/shooting-6.jpg',
                ],
            ],
            [
                'category_slug' => 'architectural',
                'slug' => 'dubai-outlet-mall',
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
                'gallery' => [
                    'assets/images/projects/dubai-outlet-mall/outlet-mall-1.jpg',
                    'assets/images/projects/dubai-outlet-mall/outlet-mall-2.jpg',
                    'assets/images/projects/dubai-outlet-mall/outlet-mall-3.jpg',
                ],
            ],
            [
                'category_slug' => 'sports',
                'slug' => 'westlake-girls',
                'title' => 'Westlake Girls Sports Facility Canopy',
                'location' => 'Sports Facility / Global Reference',
                'client_name' => 'Educational & Sports Authority',
                'covered_area' => '8,200 m²',
                'membrane_material' => 'Translucent High-Tensile PVC/PVDF',
                'year_completed' => 2019,
                'short_description' => 'Iconic sporting venue proving a winner for continuous netball and tennis court shading.',
                'full_overview' => 'An iconic sporting venue that proves a winner for netball and tennis courts. Structurflex created a continuous clear-span canopy that eliminates interior columns, shielding athletes from rain and UV while illuminating courts with natural diffused daylight.',
                'structural_challenge' => 'Eliminating center supports across multiple tournament courts while maintaining acoustic damping.',
                'engineering_solution' => 'High-frequency double-curved membrane envelopes providing natural acoustic dampening and 100% column-free play area.',
                'thumbnail_image' => 'assets/images/projects/westlake-girls-sports.jpg',
                'is_featured' => false,
                'sort_order' => 6,
                'gallery' => [
                    'assets/images/projects/westlake-girls-sports.jpg',
                ],
            ],
            [
                'category_slug' => 'air-supported',
                'slug' => 'asati-dome',
                'title' => 'ASATI Air-Supported Multisport Dome',
                'location' => 'Dubai & Northern Emirates, UAE',
                'client_name' => 'ASATI Middle East Regional Alliance',
                'covered_area' => '14,000 m²',
                'membrane_material' => 'Double-Skin Thermal Insulated Air Dome Membrane',
                'year_completed' => 2024,
                'short_description' => 'Delivered in strategic alliance with ASATI: 100% column-free inflatable arena with full HVAC.',
                'full_overview' => 'Delivered in strategic partnership with ASATI (Air Structures American Technologies, Inc., world leaders since 1963). Features 100% clear-span capability up to 150m+, advanced automated HVAC pressure management, rapid seasonal installation, and superior energy efficiency for regional sports, exhibitions, and industrial warehousing in extreme desert climates.',
                'structural_challenge' => 'Sustaining positive air pressure and air-conditioned microclimates when ambient outdoor temperatures exceed 50°C.',
                'engineering_solution' => 'Double-membrane thermal insulation with computerized sensor-driven fan blowers, back-up emergency generators, and air-lock revolving pedestrian doors.',
                'thumbnail_image' => 'assets/images/solutions/air-supported-asati.jpg',
                'is_featured' => true,
                'sort_order' => 7,
                'gallery' => [
                    'assets/images/solutions/air-supported-asati.jpg',
                    'assets/images/solutions/sports.jpg',
                ],
            ],
            [
                'category_slug' => 'infrastructure',
                'slug' => 'vmf-market',
                'title' => 'Vegetable, Meat & Fruit (VMF) Market',
                'location' => 'Al Ain, UAE',
                'client_name' => 'Al Ain Municipality',
                'covered_area' => '18,600 m²',
                'membrane_material' => 'Architectural Tensile Membrane & Sand-Proof Seals',
                'year_completed' => 2017,
                'short_description' => 'Sophisticated outdoor market canopy maintaining traditional look and feel in extreme desert heat.',
                'full_overview' => 'A sophisticated outdoor market with a traditional Emirati architectural look and feel. The challenge was mitigating desert heat and dust while preserving an open, inviting bazaar atmosphere. Delivered under turnkey contract with Al Ain Municipality.',
                'structural_challenge' => 'Massive footprint requiring natural thermal convection ventilation to avoid trapping hot air over food stalls.',
                'engineering_solution' => 'High-peak open-flue conical tensile forms encouraging upward stack effect thermal venting.',
                'thumbnail_image' => 'assets/images/projects/fruit-vegetable-market.jpg',
                'is_featured' => false,
                'sort_order' => 8,
                'gallery' => [
                    'assets/images/projects/fruit-vegetable-market.jpg',
                ],
            ],
            [
                'category_slug' => 'sports',
                'slug' => 'rio-tinto',
                'title' => 'Rio Tinto MLS Stadium Canopy',
                'location' => 'Sandy, Utah / Major League Soccer',
                'client_name' => 'Major League Soccer Franchise',
                'covered_area' => '19,500 m²',
                'membrane_material' => 'High-Tensile PTFE Architectural Fiberglass',
                'year_completed' => 2015,
                'short_description' => 'Unique tensile canopy providing the soccer stadium an aesthetic point of difference.',
                'full_overview' => 'A unique tensile canopy that gives this soccer stadium an unmistakable aesthetic point of difference. Engineered to handle seismic criteria, high snow loads, and aerodynamic uplift while giving every spectator an unobstructed view of the pitch.',
                'structural_challenge' => 'Balancing aerodynamic uplift from desert canyon winds while spanning over 40m without perimeter columns.',
                'engineering_solution' => 'Curved tubular steel masts tensioned by rear ground stays and high-translucency woven PTFE fabric.',
                'thumbnail_image' => 'assets/images/projects/rio-tinto-stadium.jpg',
                'is_featured' => false,
                'sort_order' => 9,
                'gallery' => [
                    'assets/images/projects/rio-tinto-stadium.jpg',
                    'assets/images/solutions/sports.jpg',
                ],
            ],
            [
                'category_slug' => 'infrastructure',
                'slug' => 'denver-station',
                'title' => 'Denver Union Station Landmark Canopy',
                'location' => 'Denver, Colorado',
                'client_name' => 'Regional Transit Authority',
                'covered_area' => '9,800 m²',
                'membrane_material' => 'PTFE Coated Woven Fiberglass Net',
                'year_completed' => 2014,
                'short_description' => 'Landmark design-build tension wave concourse canopy for historic railway station.',
                'full_overview' => 'A landmark design-build project for a historic railway station. Complex multi-stakeholder design-engineer-build execution resulting in a soaring PTFE canopy that shelters commuter platforms and celebrates architectural heritage.',
                'structural_challenge' => 'Sinuous wave profile geometry with tight tolerances intersecting historic brick structures and high-speed catenary power lines.',
                'engineering_solution' => '3D laser survey verification and robotic CNC membrane pattern cutting within +/- 1.5mm tolerance.',
                'thumbnail_image' => 'assets/images/projects/denver-union-station.jpg',
                'is_featured' => false,
                'sort_order' => 10,
                'gallery' => [
                    'assets/images/projects/denver-union-station.jpg',
                ],
            ],
            [
                'category_slug' => 'infrastructure',
                'slug' => 'rta-marine',
                'title' => 'RTA Marine Floating Transit Stations',
                'location' => 'Dubai Canal & Creek, UAE',
                'client_name' => 'Roads & Transport Authority (RTA Dubai)',
                'covered_area' => '4,200 m²',
                'membrane_material' => 'ETFE & PTFE Domes & Inverted Cones',
                'year_completed' => 2019,
                'short_description' => 'ETFE & PTFE domes and inverted cones custom engineered for Dubai Roads & Transport Authority.',
                'full_overview' => 'High-performance ETFE domes and inverted tensile cones custom engineered for Dubai Roads & Transport Authority (RTA) marine transit stations along the Dubai Canal and Creek. Built to endure high humidity, marine salinity, and coastal wind loading with minimal maintenance.',
                'structural_challenge' => 'Dynamic tidal movement and high-salinity marine atmosphere prone to corroding conventional finishes.',
                'engineering_solution' => 'Marine-grade 316 stainless steel fittings with fluoropolymer-coated membranes that self-clean with natural dew and rainfall.',
                'thumbnail_image' => 'assets/images/solutions/transport.jpg',
                'is_featured' => true,
                'sort_order' => 11,
                'gallery' => [
                    'assets/images/solutions/transport.jpg',
                    'assets/images/projects/denver-union-station.jpg',
                ],
            ],
            [
                'category_slug' => 'sports',
                'slug' => 'arena-corinthians',
                'title' => 'Arena Corinthians World Cup Stadium Ceiling',
                'location' => 'São Paulo, Brazil',
                'client_name' => 'FIFA Organizing Committee',
                'covered_area' => '28,000 m²',
                'membrane_material' => 'Smooth Acoustic & Reflective Tensile Membrane',
                'year_completed' => 2014,
                'short_description' => 'Smooth membrane ceiling for 2014 FIFA World Cup opening stadium fast-tracked from underside.',
                'full_overview' => 'Smooth membrane ceiling for FIFA World Cup opening match stadium. Fast-track installation from the underside of the massive cantilevered roof steelwork, delivering clean aesthetics, integrated lighting concealment, and stadium acoustics for over 65,000 attendees.',
                'structural_challenge' => 'Installing 28,000m² of fabric 40 meters in the air beneath structural trusses without crane access to the pitch.',
                'engineering_solution' => 'Engineered inverted rigging catenary system installed using specialized rope-access teams ahead of the international broadcast deadline.',
                'thumbnail_image' => 'assets/images/projects/arena-corinthians.jpg',
                'is_featured' => true,
                'sort_order' => 12,
                'gallery' => [
                    'assets/images/projects/arena-corinthians.jpg',
                    'assets/images/projects/rio-tinto-stadium.jpg',
                    'assets/images/solutions/sports.jpg',
                ],
            ],
        ];

        foreach ($projects as $projData) {
            $catId = $categoryMap[$projData['category_slug']] ?? null;
            $gallery = $projData['gallery'] ?? [];
            unset($projData['category_slug'], $projData['gallery']);
            $projData['category_id'] = $catId;

            $project = Project::updateOrCreate(['slug' => $projData['slug']], $projData);

            // Seed images
            $project->images()->delete();
            foreach ($gallery as $idx => $img) {
                ProjectImage::create([
                    'project_id' => $project->id,
                    'image_path' => $img,
                    'sort_order' => $idx + 1,
                ]);
            }
        }

        // 5. Services / Solutions
        $services = [
            [
                'title' => 'Architectural Tensile & ETFE Structures',
                'slug' => 'architectural-tensile',
                'subtitle' => 'Pioneering Daylighting & Sculptural Envelopes',
                'badge' => 'ETFE & PTFE',
                'hero_image' => 'assets/images/solutions/architectural.png',
                'icon_name' => 'arch-tensile',
                'summary' => 'Iconic translucent single skin and cushion ETFE daylighting systems, sculptural PTFE envelopes, and bespoke building atriums that elevate architectural vision.',
                'description' => 'Structurflex provides end-to-end design, FEA engineering, fabrication, and installation of iconic tensile membrane structures across the Middle East. Utilizing architectural PTFE, pneumatic ETFE cushions, and high-tensile PVC/PVDF materials, our structures achieve extraordinary spans while deflecting up to 85% of solar heat gain.',
                'technical_specs' => [
                    'Spans' => 'Up to 60m+ clear spans without internal columns',
                    'Materials' => 'PTFE Glass, ETFE Foil, PVC/PVDF Precontraint',
                    'Thermal Performance' => 'Solar heat deflection up to 85%',
                    'Warranty' => 'Up to 25 years guaranteed service life',
                ],
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Sports & Recreation Stadia Canopies',
                'slug' => 'sports-canopies',
                'subtitle' => 'Clear-Span Shading for Stadiums & Arenas',
                'badge' => 'Stadia & Arenas',
                'hero_image' => 'assets/images/solutions/sports.jpg',
                'icon_name' => 'sports-canopy',
                'summary' => 'Clear-span spectator grandstand roofs, multi-sport training court canopies, and Olympic athletic covers with uninterrupted sightlines.',
                'description' => 'From FIFA World Cup venues to community tennis and equestrian centers, Structurflex engineers aerodynamically stable membrane roofs that withstand extreme gusts and provide optimal shadow coverage throughout peak daylight hours.',
                'technical_specs' => [
                    'Sightlines' => '100% column-free spectator sightlines',
                    'Wind Resistance' => 'Engineered for up to 160 km/h gusts',
                    'Acoustics' => 'Tensioned acoustic membrane baffling',
                    'Lighting' => 'Seamless floodlight and drainage integration',
                ],
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'Commercial, Retail & Atrium Daylighting',
                'slug' => 'commercial-atriums',
                'subtitle' => 'Daylit Commercial Centers & Energy-Saving Skylights',
                'badge' => 'Malls & Atriums',
                'hero_image' => 'assets/images/solutions/commercial.jpg',
                'icon_name' => 'retail-atrium',
                'summary' => 'Lightweight ETFE skylights and tensile canopies transforming desert shopping centers into luminous, pedestrian-friendly lifestyle destinations.',
                'description' => 'Replace heavy glass skylights with 1/100th weight ETFE cushion systems, dramatically reducing structural steel loads and delivering soft, natural diffused light that drives higher customer dwell time.',
                'technical_specs' => [
                    'Light Transmission' => 'Adjustable from 10% to 95%',
                    'Weight' => 'Less than 1% the weight of equivalent double glass',
                    'Maintenance' => 'Self-cleaning fluoropolymer film',
                ],
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'title' => 'Transport & Infrastructure Canopies',
                'slug' => 'transport-infrastructure',
                'subtitle' => 'Metro, Airport & Marine Transit Shade Systems',
                'badge' => 'Transit Hubs',
                'hero_image' => 'assets/images/solutions/transport.jpg',
                'icon_name' => 'transit-canopy',
                'summary' => 'Durable public transit canopies for high-volume international airports, metro concourses, railway hubs, and marine ferry stations.',
                'description' => 'High-durability public sector structures engineered to resist corrosive coastal humidity, vehicle exhausts, and continuous passenger foot traffic with zero disruption to daily transit schedules.',
                'technical_specs' => [
                    'Standards' => 'Compliant with UAE Civil Defense & international transit codes',
                    'Durability' => 'Non-corrosive marine grade 316 stainless rigging',
                    'Fire Rating' => 'Class A1 / non-combustible materials',
                ],
                'sort_order' => 4,
                'is_active' => true,
            ],
            [
                'title' => 'Industrial & Warehouse Structures',
                'slug' => 'industrial-logistics',
                'subtitle' => 'Wide-Span Bulk Storage & Logistics Enclosures',
                'badge' => 'Bulk Logistics',
                'hero_image' => 'assets/images/solutions/industrial.jpg',
                'icon_name' => 'industrial-warehouse',
                'summary' => 'Wide-span storage enclosures, bulk material protection, and rapidly deployable logistics shelters engineered for harsh Middle Eastern weather.',
                'description' => 'Heavy-duty industrial tensile membrane buildings designed for rapid turnkey deployment. Providing 100% weather protection, UV blockout, and dust mitigation for bulk mineral storage, agricultural stockpiles, and logistics warehouses across the GCC.',
                'technical_specs' => [
                    'Clear Span' => 'Up to 80m column-free clear spans',
                    'Deployment' => 'Rapid modular erection in weeks',
                    'UV Protection' => '100% UV blockout and heat deflection',
                    'Corrosion' => 'Hot-dip galvanized heavy-duty framing',
                ],
                'sort_order' => 5,
                'is_active' => true,
            ],
            [
                'title' => 'ASATI Air-Supported Multisport Dome',
                'slug' => 'air-supported-domes',
                'subtitle' => 'World-Leading Clear-Span Air Domes in Strategic Alliance with ASATI',
                'badge' => 'ASATI UAE Partner',
                'hero_image' => 'assets/images/solutions/air-supported-asati.jpg',
                'icon_name' => 'air-dome',
                'summary' => '100% column-free clear-span domes spanning up to 150m+, delivered in exclusive regional alliance with ASATI with integrated smart HVAC for multisport arenas, seasonal exhibition halls, and climate-controlled storage.',
                'description' => 'In strategic partnership with ASATI (Air Structures American Technologies, Inc., global pioneer since 1963), Structurflex Middle East delivers cutting-edge air-supported dome structures across the GCC and North Africa. Offering unprecedented unobstructed clear spans up to 150m+ with computerized sensor-driven fan blowers, tri-redundant backup generators, smart automated HVAC thermal management, and rapid seasonal installation for regional sports, exhibitions, and industrial warehousing in extreme desert climates.',
                'technical_specs' => [
                    'Clear Span' => 'Up to 150m+ completely column-free interior volume',
                    'Material' => 'Double-Skin Thermal Insulated Air Dome Membrane',
                    'Thermal & HVAC' => 'Smart automated pressure control and microclimate HVAC',
                    'Deployment' => 'Rapid modular commissioning in weeks vs. years for steel halls',
                    'Safety Systems' => 'Tri-redundant inflation system with automatic emergency generator',
                ],
                'sort_order' => 6,
                'is_active' => true,
            ],
            [
                'title' => 'Lifecycle Maintenance, Inspection & AMC',
                'slug' => 'lifecycle-maintenance',
                'subtitle' => 'Preserving Tension Integrity & 35+ Year Lifespans',
                'badge' => 'Asset Stewardship',
                'hero_image' => 'assets/images/solutions/lifecycle-amc.jpg',
                'icon_name' => 'maintenance-audit',
                'summary' => 'Comprehensive condition audits, biaxial membrane tension calibration, ultrasonic weld verification, specialized non-destructive cleaning, and certified annual maintenance contracts.',
                'description' => 'Ensuring tension membrane structures retain structural safety, aesthetic brilliance, and weather tightness for 35+ years. Our certified rope-access engineers provide comprehensive condition audits, laser measurement of boundary cable pre-tensioning, ultrasonic weld inspection, seam tear testing, non-destructive cleaning, and certified Annual Maintenance Contracts (AMC) with guaranteed 24/7 emergency response across UAE, GCC and North Africa.',
                'technical_specs' => [
                    'Inspections' => 'Laser measurement of boundary cable pre-tensioning & deflection',
                    'Testing' => 'Ultrasonic weld inspection and seam tear strength testing',
                    'Access' => 'IRATA certified master rope-access engineering teams',
                    'Coverage' => 'Regional Asset Fleet (>150,000 m² across UAE & GCC)',
                    'AMC Response' => 'Guaranteed 24/7 emergency response & annual maintenance contracts',
                ],
                'sort_order' => 7,
                'is_active' => true,
            ],
        ];

        foreach ($services as $srv) {
            Service::updateOrCreate(['slug' => $srv['slug']], $srv);
        }

        // 6. Posts / Technical Whitepapers
        $posts = [
            [
                'title' => 'The Evolution of ETFE: From Aerospace to Architectural Icons',
                'slug' => 'evolution-of-etfe-architecture',
                'category' => 'Whitepaper',
                'excerpt' => 'How single skin and multi-layer pneumatic ETFE cushions revolutionized high-performance daylighting in modern Middle Eastern atriums.',
                'content' => 'Ethylene Tetrafluoroethylene (ETFE) was originally synthesized by DuPont in the 1970s as an aerospace wire-coating material designed to withstand cosmic radiation and thermal extremes. Over the past two decades, ETFE has undergone a stunning transformation into one of the most celebrated architectural building envelope media of the 21st century. In desert environments such as the GCC, ETFE cushions provide thermal U-values comparable to triple glazing while imposing only a fraction of the structural dead-load on supporting frames.',
                'featured_image' => 'assets/images/solutions/architectural.png',
                'author' => 'Dr. Julian Vane, Structural Facade Specialist',
                'reading_time_minutes' => 6,
                'published_at' => now()->subDays(12),
            ],
            [
                'title' => 'Engineering High-Wind & Desert Resilient Tensile Membranes',
                'slug' => 'engineering-high-wind-desert-membranes',
                'category' => 'Engineering Guide',
                'excerpt' => 'Finite element modeling (FEA) and anti-wicking lacquers engineered to resist sandstorms, solar UV degradation, and thermal expansion in the GCC.',
                'content' => 'Designing lightweight membrane architecture for the Arabian Peninsula requires addressing a unique convergence of mechanical challenges: extreme daytime thermal peaks (>50°C), rapid nocturnal radiative cooling, abrasive airborne silica particles during Shamal sandstorms, and episodic hyper-localized microburst wind velocities. This technical guide outlines the non-linear form-finding formulas and bi-axial pretension calibrations utilized by SFXMEC engineering desks to maintain membrane equilibrium across 30+ year lifespans.',
                'featured_image' => 'assets/images/solutions/commercial.jpg',
                'author' => 'Eng. Tarek Mansour, Lead FEA Specialist SFXMEC',
                'reading_time_minutes' => 8,
                'published_at' => now()->subDays(24),
            ],
            [
                'title' => 'Air-Supported Dome Structures: The ASATI Partnership Advantage',
                'slug' => 'air-supported-dome-structures-asati',
                'category' => 'Technology Insight',
                'excerpt' => 'Evaluating total cost of ownership, clear-span flexibility up to 150m+, and energy savings of modern air-supported domes for athletics and industry.',
                'content' => 'Air-supported structures represent the ultimate expression of structural efficiency: utilizing gentle internal air pressure rather than rigid steel columns to support vast clear spans. Through Structurflex Middle East\'s strategic partnership with ASATI (Air Structures American Technologies, Inc.), clients across the UAE, Saudi Arabia, and Egypt gain access to proprietary bias-ply membrane fabrics and computerized HVAC pressurization units that slash construction timelines by over 70% compared to traditional steel halls.',
                'featured_image' => 'assets/images/solutions/air-supported-asati.jpg',
                'author' => 'SFXMEC Commercial & Sports Practice',
                'reading_time_minutes' => 5,
                'published_at' => now()->subDays(35),
            ],
            [
                'title' => 'Lifecycle Maintenance & Inspection: Preserving Structural Integrity',
                'slug' => 'lifecycle-maintenance-inspection-protocols',
                'category' => 'Maintenance Protocol',
                'excerpt' => 'Laser cable re-tensioning, specialized non-abrasive washing protocols, and structural audits that extend membrane life past 35+ years.',
                'content' => 'A well-engineered tensile membrane structure possesses an extraordinary lifespan, but realizing its full economic potential requires periodic verification of cable prestress and weld integrity. In the harsh ultraviolet environment of the Middle East, fine airborne dust can accumulate on horizontal surfaces if not properly managed. This protocol document details the annual audit checklist implemented under SFXMEC Annual Maintenance Contracts (AMC).',
                'featured_image' => 'assets/images/solutions/lifecycle-amc.jpg',
                'author' => 'SFXMEC Field Operations Division',
                'reading_time_minutes' => 7,
                'published_at' => now()->subDays(48),
            ],
        ];

        foreach ($posts as $post) {
            Post::updateOrCreate(['slug' => $post['slug']], $post);
        }
    }
}
