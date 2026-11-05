<?php

use App\Models\Service;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        // 1. ASATI Air-Supported Multisport Dome
        Service::updateOrCreate(
            ['slug' => 'air-supported-domes'],
            [
                'title' => 'ASATI Air-Supported Multisport Dome',
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
            ]
        );

        // 2. Lifecycle Maintenance, Inspection & AMC
        Service::updateOrCreate(
            ['slug' => 'lifecycle-maintenance'],
            [
                'title' => 'Lifecycle Maintenance, Inspection & AMC',
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
            ]
        );
    }

    public function down(): void
    {
        // Safe no-op
    }
};
