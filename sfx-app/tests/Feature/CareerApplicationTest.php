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

    public function test_interviewer_feedback_can_be_saved_on_career_application()
    {
        $application = CareerApplication::create([
            'job_title' => 'Senior Tensile Structural Engineer',
            'name' => 'Eng. Khalid Al-Mutawa',
            'email' => 'khalid@example.com',
            'phone' => '+971 50 111 2233',
            'status' => 'interviewed',
            'interviewer_name' => 'Eng. Tariq Mansoor',
            'interview_date' => '2026-10-30',
            'interview_rating' => 'strongly_recommended',
            'interviewer_feedback' => 'Exceptional technical depth in non-linear membrane dynamics and Easy software. Recommended for principal role.',
        ]);

        $this->assertDatabaseHas('career_applications', [
            'id' => $application->id,
            'interviewer_name' => 'Eng. Tariq Mansoor',
            'interview_rating' => 'strongly_recommended',
            'interviewer_feedback' => 'Exceptional technical depth in non-linear membrane dynamics and Easy software. Recommended for principal role.',
        ]);

        $fresh = $application->fresh();
        $this->assertEquals('Eng. Tariq Mansoor', $fresh->interviewer_name);
        $this->assertEquals('2026-10-30', $fresh->interview_date->format('Y-m-d'));
        $this->assertEquals('strongly_recommended', $fresh->interview_rating);
        $this->assertStringContainsString('Exceptional technical depth', $fresh->interviewer_feedback);
    }

    public function test_admin_can_view_career_application_edit_page_with_interviewer_feedback_fields()
    {
        $user = \App\Models\User::create([
            'name' => 'SFXMEC Administrator',
            'email' => 'admin_test@structurflex.ae',
            'password' => bcrypt('password'),
        ]);

        $application = CareerApplication::create([
            'job_title' => 'Computational Designer',
            'name' => 'Candidate Test',
            'email' => 'candidate_test@example.com',
            'status' => 'shortlisted',
        ]);

        $response = $this->actingAs($user)->get("/admin/career-applications/{$application->id}/edit");
        $response->assertStatus(200);
        $response->assertSee('Interviewer Feedback &amp; Technical Assessment', false);
        $response->assertSee('interviewer_feedback');
        $response->assertSee('interviewer_name');
    }
}
