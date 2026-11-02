<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Setting;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ManageAboutTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_view_manage_about_page_with_upload_and_preview(): void
    {
        $user = User::create([
            'name' => 'Admin User',
            'email' => 'admin@structurflex.ae',
            'password' => bcrypt('password'),
        ]);

        Setting::set('about_award_image', 'assets/images/credentials/ministry-public-works-award.png');

        $response = $this->actingAs($user)->get('/admin/manage-about');
        $response->assertStatus(200);
        $response->assertSee('Upload Award Photo');
        $response->assertSee('Current Award Photo Preview');
        $response->assertSee('Award Photo Path or URL');
    }
}

