<?php

namespace App\Filament\Widgets;

use App\Models\CareerApplication;
use App\Models\ContactInquiry;
use App\Models\Project;
use App\Models\ProjectCategory;
use App\Models\Service;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Carbon;

class BusinessOverviewStats extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $totalInquiries = ContactInquiry::count();
        $pendingInquiries = ContactInquiry::where('status', 'pending')->count();

        // 7-day inquiries sparkline trend
        $inquiriesTrend = [];
        for ($i = 6; $i >= 0; $i--) {
            $day = Carbon::today()->subDays($i);
            $inquiriesTrend[] = ContactInquiry::whereDate('created_at', $day)->count();
        }

        $totalProjects = Project::count();
        $featuredProjects = Project::where('is_featured', true)->count();

        $totalApplications = CareerApplication::count();
        $pendingApplications = CareerApplication::where('status', 'pending')->count();

        $totalServices = Service::count();
        $totalCategories = ProjectCategory::count();

        return [
            Stat::make('Commercial Inquiries', number_format($totalInquiries))
                ->description($pendingInquiries > 0 ? "{$pendingInquiries} new pending review" : 'All inquiries reviewed')
                ->descriptionIcon($pendingInquiries > 0 ? 'heroicon-m-inbox-arrow-down' : 'heroicon-m-check-badge')
                ->color($pendingInquiries > 0 ? 'warning' : 'success')
                ->chart($inquiriesTrend),

            Stat::make('Executed Projects', number_format($totalProjects))
                ->description("{$featuredProjects} featured engineering landmarks")
                ->descriptionIcon('heroicon-m-building-office-2')
                ->color('primary'),

            Stat::make('Career Applications', number_format($totalApplications))
                ->description($pendingApplications > 0 ? "{$pendingApplications} candidates pending" : 'Applications up to date')
                ->descriptionIcon('heroicon-m-user-group')
                ->color($pendingApplications > 0 ? 'info' : 'gray'),

            Stat::make('Active Solutions', number_format($totalServices))
                ->description("Across {$totalCategories} market sectors")
                ->descriptionIcon('heroicon-m-squares-2x2')
                ->color('gray'),
        ];
    }
}
