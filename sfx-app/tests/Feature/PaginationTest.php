<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PaginationTest extends TestCase
{
    use RefreshDatabase;

    public function test_projects_list_is_paginated_with_12_per_page(): void
    {
        for ($i = 1; $i <= 15; $i++) {
            Project::create([
                'title' => "Project {$i}",
                'slug' => "project-{$i}",
                'location' => 'Dubai, UAE',
                'short_description' => "Short description for project {$i}",
                'thumbnail_image' => 'assets/images/projects/al-jamea.jpg',
                'sort_order' => $i,
            ]);
        }

        $response = $this->get('/projects');
        $response->assertStatus(200);

        // Assert view receives paginated projects
        $response->assertViewHas('projects', function ($projects) {
            return $projects->perPage() === 12 && $projects->total() === 15 && $projects->hasPages();
        });

        // Assert page 2 link is visible
        $response->assertSee('custom-pagination-nav');
        $response->assertSee('page=2');
    }

    public function test_resources_insights_list_is_paginated_with_9_articles_per_page(): void
    {
        for ($i = 1; $i <= 12; $i++) {
            Post::create([
                'title' => "Technical Article {$i}",
                'slug' => "technical-article-{$i}",
                'category' => 'Engineering',
                'excerpt' => "Excerpt for article {$i}",
                'content' => "Full body content for article {$i}",
                'featured_image' => 'assets/images/blog/article.jpg',
                'status' => 'published',
                'published_at' => now(),
            ]);
        }

        $response = $this->get('/insights');
        $response->assertStatus(200);

        // Assert view receives paginated posts
        $response->assertViewHas('posts', function ($posts) {
            return $posts->perPage() === 9 && $posts->total() === 12 && $posts->hasPages();
        });

        // Assert pagination nav is rendered
        $response->assertSee('custom-pagination-nav');
        $response->assertSee('page=2');
    }
}

