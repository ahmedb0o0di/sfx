<?php

use App\Models\Project;
use App\Models\ProjectCategory;
use App\Models\ProjectImage;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        $sportsCat = ProjectCategory::firstOrCreate(
            ['slug' => 'sports'],
            ['name' => 'Sports & Stadia', 'filter_tag' => 'sports', 'sort_order' => 2]
        );

        $project = Project::updateOrCreate(
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

        // Delete existing images for this project to avoid duplicates on re-run
        ProjectImage::where('project_id', $project->id)->delete();

        $galleryImages = [
            [
                'image_path' => 'assets/images/projects/abu-dhabi-ladies-club/adlc-1.jpg',
                'caption' => 'Multi-Feature Architectural Tensile Roof Structures',
                'sort_order' => 1,
            ],
            [
                'image_path' => 'assets/images/projects/abu-dhabi-ladies-club/adlc-2.jpg',
                'caption' => 'High-Tensile Clear-Span Membrane Canopy',
                'sort_order' => 2,
            ],
            [
                'image_path' => 'assets/images/projects/abu-dhabi-ladies-club/adlc-3.jpg',
                'caption' => 'Under-Canopy Diffused Daylight & Structural Mast Detailing',
                'sort_order' => 3,
            ],
            [
                'image_path' => 'assets/images/projects/abu-dhabi-ladies-club/adlc-4.jpg',
                'caption' => 'Outdoor Sports & Courtyard Shading Integration',
                'sort_order' => 4,
            ],
            [
                'image_path' => 'assets/images/projects/abu-dhabi-ladies-club/adlc-5.jpg',
                'caption' => 'Perimeter Tension Cables and Stainless Steel Rigging',
                'sort_order' => 5,
            ],
        ];

        foreach ($galleryImages as $imgData) {
            ProjectImage::create([
                'project_id' => $project->id,
                'image_path' => $imgData['image_path'],
                'caption' => $imgData['caption'],
                'sort_order' => $imgData['sort_order'],
            ]);
        }
    }

    public function down(): void
    {
        $project = Project::where('slug', 'abu-dhabi-ladies-club')->first();
        if ($project) {
            ProjectImage::where('project_id', $project->id)->delete();
            $project->delete();
        }
    }
};
