<?php

namespace Tests\Feature;

use App\Models\Career;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomepageCareerPaginationTest extends TestCase
{
    use RefreshDatabase;

    public function test_homepage_shows_pagination_when_careers_exceed_three(): void
    {
        for ($i = 1; $i <= 4; $i++) {
            Career::create([
                'title' => "Engineering Role {$i}",
                'slug' => "engineering-role-{$i}",
                'description' => "Description for role {$i}",
                'is_active' => true,
                'sort_order' => $i,
            ]);
        }

        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('id="career-pagination"', false);
        $response->assertSee('data-career-index="0"', false);
        $response->assertSee('data-career-index="1"', false);
        $response->assertSee('data-career-index="2"', false);
        $response->assertSee('data-career-index="3"', false);
    }

    public function test_homepage_hides_pagination_when_careers_are_three_or_less(): void
    {
        for ($i = 1; $i <= 3; $i++) {
            Career::create([
                'title' => "Engineering Role {$i}",
                'slug' => "engineering-role-{$i}",
                'description' => "Description for role {$i}",
                'is_active' => true,
                'sort_order' => $i,
            ]);
        }

        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertDontSee('id="career-pagination"', false);
    }
}
