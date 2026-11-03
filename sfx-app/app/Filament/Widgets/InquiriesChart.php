<?php

namespace App\Filament\Widgets;

use App\Models\ContactInquiry;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;

class InquiriesChart extends ChartWidget
{
    protected static ?string $heading = 'Inquiries & Proposals Trend (Last 30 Days)';

    protected static ?int $sort = 2;

    protected int | string | array $columnSpan = [
        'md' => 1,
        'xl' => 2,
    ];

    protected function getData(): array
    {
        $days = [];
        $counts = [];

        for ($i = 29; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);
            $days[] = $date->format('M j');
            $counts[] = ContactInquiry::whereDate('created_at', $date)->count();
        }

        return [
            'datasets' => [
                [
                    'label' => 'New Inquiries',
                    'data' => $counts,
                    'borderColor' => '#0B5ED7',
                    'backgroundColor' => 'rgba(11, 94, 215, 0.15)',
                    'fill' => true,
                    'tension' => 0.35,
                ],
            ],
            'labels' => $days,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
