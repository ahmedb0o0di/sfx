<?php

use App\Models\Post;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('posts', 'video_path')) {
            Schema::table('posts', function (Blueprint $table) {
                $table->string('video_path')->nullable()->after('featured_image');
            });
        }

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
    }

    public function down(): void
    {
        Post::where('slug', 'first-etfe-single-skin-roof-kenya')->delete();

        if (Schema::hasColumn('posts', 'video_path')) {
            Schema::table('posts', function (Blueprint $table) {
                $table->dropColumn('video_path');
            });
        }
    }
};
