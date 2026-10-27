<?php

namespace Tests\Feature;

use App\Models\Career;
use App\Models\CareerApplication;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CareerApplicationTest extends TestCase
{
    use RefreshDatabase;
    public function test_career_details_page_loads_successfully()
    {
        $career = Career::first();
        if (!$career) {
            $career = Career::create([
                'title' => 'Tensile Structural Architect',
                'description' => 'Architectural form-finding and FEA engineering.',
                'is_active' => true,
            ]);
        }

        $response = $this->get('/careers/' . $career->slug);
        $response->assertStatus(200);
        $response->assertSee($career->title);
        $response->assertSee('Apply for this Position');
    }

    public function test_candidate_can_submit_cv_and_response()
    {
        Storage::fake('public');

        $career = Career::create([
            'title' => 'Senior Tensile Structural Engineer',
            'description' => 'Architectural form-finding and FEA engineering.',
            'is_active' => true,
        ]);
        $file = UploadedFile::fake()->create('ahmed_cv.pdf', 500, 'application/pdf');

        $payload = [
            'career_id' => $career->id,
            'job_title' => $career->title,
            'name' => 'Eng. Ahmed Mansoor',
            'email' => 'ahmed.mansoor@example.com',
            'phone' => '+971 50 777 8899',
            'portfolio_url' => 'https://linkedin.com/in/ahmed-mansoor',
            'cover_letter' => 'Over 8 years experience in parametric tensile membrane structures.',
            'cv' => $file,
        ];

        $response = $this->post('/careers/apply', $payload);
        $response->assertSessionHas('career_success');

        $this->assertDatabaseHas('career_applications', [
            'email' => 'ahmed.mansoor@example.com',
            'name' => 'Eng. Ahmed Mansoor',
            'career_id' => $career->id,
        ]);

        $app = CareerApplication::where('email', 'ahmed.mansoor@example.com')->first();
        $this->assertNotNull($app->cv_path);
        Storage::disk('public')->assertExists($app->cv_path);
    }
}
