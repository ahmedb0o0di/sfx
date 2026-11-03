<?php

namespace App\Filament\Widgets;

use App\Models\ProjectCategory;
use Filament\Widgets\ChartWidget;

class ProjectsSectorChart extends ChartWidget
{
    protected static ?string $heading = 'Projects Portfolio by Sector';

    protected static ?int $sort = 3;

    protected int | string | array $columnSpan = [
        'md' => 1,
        'xl' => 1,
    ];

    protected function getData(): array
    {
        $categories = ProjectCategory::withCount('projects')->get();

        $labels = $categories->pluck('name')->toArray();
        $data = $categories->pluck('projects_count')->toArray();

        $colors = [
            '#0B5ED7', // Azure Blue
            '#008751', // Forest Green
            '#D99B26', // Gold Amber
            '#17A2B8', // Teal
            '#6F42C1', // Purple
            '#E83E8C', // Pink
            '#FD7E14', // Orange
        ];

        return [
            'datasets' => [
                [
                    'label' => 'Projects',
                    'data' => $data,
                    'backgroundColor' => array_slice($colors, 0, count($data)),
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
