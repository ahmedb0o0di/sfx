<?php

use App\Models\Project;
use App\Models\ProjectImage;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        // Find the old duplicate project with slug 'abu-dhabi-shooting'
        $oldProject = Project::where('slug', 'abu-dhabi-shooting')->first();
        if ($oldProject) {
            // Delete associated images
            ProjectImage::where('project_id', $oldProject->id)->delete();
            // Delete the duplicate project
            $oldProject->delete();
        }
    }

    public function down(): void
    {
        // Safe no-op
    }
};

