<?php

namespace App\Filament\Pages;

use App\Models\Setting;
use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class ManageHeader extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-bars-3';

    protected static ?string $navigationGroup = 'Site Settings & Branding';

    protected static ?string $navigationLabel = 'Header & Hero';

    protected static ?string $title = 'Header & Homepage Hero Management';

    protected static ?int $navigationSort = 1;

    protected static string $view = 'filament.pages.manage-header';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill([
            // 1. Top Navbar Settings
            'header_heritage_line1' => Setting::get('header_heritage_line1', 'Years of Heritage'),
            'header_heritage_line2' => Setting::get('header_heritage_line2', '(Since 1937)'),
            'header_cta_text' => Setting::get('header_cta_text', 'Request a Consultation'),
            'header_cta_url' => Setting::get('header_cta_url', '/contact'),
            'header_cta_visible' => (bool) Setting::get('header_cta_visible', true),
            'header_nav_menu' => $this->getInitialNavMenu(),

            // 2. Homepage Hero Banner
            'hero_pill_badge' => Setting::get('hero_pill_badge', '85+ Years Heritage'),
            'hero_pill_text' => Setting::get('hero_pill_text', 'Specialized Tensile & Lightweight Contractor'),
            'hero_title' => Setting::get('hero_title', 'Engineering Inspiring Spaces.<br>Delivering Lasting Performance.'),
            'hero_subtitle' => Setting::get('hero_subtitle', 'Specialists in Tensile Membrane, Lightweight and Air-Supported Structures across the Middle East, Africa and beyond. Turnkey design development, non-linear engineering, cleanroom fabrication, and lifetime structural maintenance.'),
            'hero_btn1_text' => Setting::get('hero_btn1_text', 'Our Solutions'),
            'hero_btn1_url' => Setting::get('hero_btn1_url', '#solutions'),
            'hero_btn2_text' => Setting::get('hero_btn2_text', 'View Projects'),
            'hero_btn2_url' => Setting::get('hero_btn2_url', '/projects'),

            // 3. Floating ASATI Partnership Card
            'hero_asati_badge' => Setting::get('hero_asati_badge', 'Strategic Regional Alliance'),
            'hero_asati_title' => Setting::get('hero_asati_title', 'Delivering Air-Supported Structures Across MENA'),
            'hero_asati_desc' => Setting::get('hero_asati_desc', 'In partnership with ASATI (Air Structures American Technologies, Inc.), delivering turnkey air-supported domes for sports arenas, industrial bulk warehousing, seasonal exhibitions, and rapid-deployment facilities.'),
            'hero_asati_spec1_val' => Setting::get('hero_asati_spec1_val', '150m+'),
            'hero_asati_spec1_label' => Setting::get('hero_asati_spec1_label', 'Clear Span'),
            'hero_asati_spec2_val' => Setting::get('hero_asati_spec2_val', 'HVAC'),
            'hero_asati_spec2_label' => Setting::get('hero_asati_spec2_label', 'Climate Control'),
            'hero_asati_spec3_val' => Setting::get('hero_asati_spec3_val', 'Rapid'),
            'hero_asati_spec3_label' => Setting::get('hero_asati_spec3_label', 'Turnkey Erection'),
            'hero_asati_link_text' => Setting::get('hero_asati_link_text', 'Learn More About ASATI Air Domes'),
            'hero_asati_link_url' => Setting::get('hero_asati_link_url', '/solutions#air-supported'),

            // 4. 5-Column Trust Metrics Bar
            'stat_1_val' => Setting::get('stat_1_val', '85+'),
            'stat_1_label' => Setting::get('stat_1_label', 'Years of Heritage'),
            'stat_1_sub' => Setting::get('stat_1_sub', 'Originated in 1937'),

            'stat_2_val' => Setting::get('stat_2_val', '9,000+'),
            'stat_2_label' => Setting::get('stat_2_label', 'Projects Delivered'),
            'stat_2_sub' => Setting::get('stat_2_sub', 'Proven Global Track Record'),

            'stat_3_val' => Setting::get('stat_3_val', '30+'),
            'stat_3_label' => Setting::get('stat_3_label', 'Countries Served'),
            'stat_3_sub' => Setting::get('stat_3_sub', 'Middle East, Africa & Beyond'),

            'stat_4_val' => Setting::get('stat_4_val', 'End-to-End'),
            'stat_4_label' => Setting::get('stat_4_label', 'Turnkey Solutions'),
            'stat_4_sub' => Setting::get('stat_4_sub', 'From Design to Lifecycle AMC'),

            'stat_5_val' => Setting::get('stat_5_val', 'ISO Certified'),
            'stat_5_label' => Setting::get('stat_5_label', 'Safety, Quality & Eco'),
            'stat_5_sub' => Setting::get('stat_5_sub', 'ISO 9001 | 14001 | 45001'),
        ]);
    }

    protected function getInitialNavMenu(): array
    {
        $saved = Setting::get('header_nav_menu');
        if ($saved) {
            $decoded = json_decode($saved, true);
            if (is_array($decoded) && count($decoded) > 0) {
                return $decoded;
            }
        }

        return [
            ['page' => 'home', 'label' => 'Home', 'url' => '/', 'is_visible' => true],
            ['page' => 'solutions', 'label' => 'Solutions', 'url' => '/solutions', 'is_visible' => true],
            ['page' => 'projects', 'label' => 'Projects', 'url' => '/projects', 'is_visible' => true],
            ['page' => 'capabilities', 'label' => 'Capabilities', 'url' => '/solutions#capabilities', 'is_visible' => true],
            ['page' => 'about', 'label' => 'About Us', 'url' => '/about', 'is_visible' => true],
            ['page' => 'blog', 'label' => 'Resources', 'url' => '/insights', 'is_visible' => true],
            ['page' => 'careers', 'label' => 'Careers', 'url' => '/contact?inquiry=careers', 'is_visible' => true],
            ['page' => 'contact', 'label' => 'Contact', 'url' => '/contact', 'is_visible' => true],
        ];
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                // 1. Top Navbar Settings
                Section::make('Top Navigation Bar')
                    ->description('Configure the top fixed site header, heritage logo subtitle, navigation links, and consultation action button.')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('header_heritage_line1')
                                    ->label('Logo Heritage Badge (Top Line)')
                                    ->placeholder('Years of Heritage')
                                    ->required(),

                                TextInput::make('header_heritage_line2')
                                    ->label('Logo Heritage Year (Sub-Line)')
                                    ->placeholder('(Since 1937)')
                                    ->required(),
                            ]),

                        Grid::make(3)
                            ->schema([
                                TextInput::make('header_cta_text')
                                    ->label('Header Button Label')
                                    ->placeholder('Request a Consultation')
                                    ->required(),

                                TextInput::make('header_cta_url')
                                    ->label('Header Button URL')
                                    ->placeholder('/contact')
                                    ->required(),

                                Toggle::make('header_cta_visible')
                                    ->label('Show Header Button')
                                    ->default(true),
                            ]),

                        Repeater::make('header_nav_menu')
                            ->label('Navigation Menu Items')
                            ->description('Reorder, add, or toggle links displayed in the main top header menu.')
                            ->schema([
                                Select::make('page')
                                    ->label('Destination Page')
                                    ->options([
                                        'home' => 'Home (/)',
                                        'solutions' => 'Solutions (/solutions)',
                                        'projects' => 'Projects (/projects)',
                                        'capabilities' => 'Capabilities (#capabilities)',
                                        'about' => 'About Us (/about)',
                                        'blog' => 'Resources / Insights (/insights)',
                                        'careers' => 'Careers (/contact?inquiry=careers)',
                                        'contact' => 'Contact (/contact)',
                                        'custom' => 'Custom External or Anchor URL',
                                    ])
                                    ->required()
                                    ->reactive()
                                    ->afterStateUpdated(function ($state, callable $set) {
                                        $labels = [
                                            'home' => 'Home',
                                            'solutions' => 'Solutions',
                                            'projects' => 'Projects',
                                            'capabilities' => 'Capabilities',
                                            'about' => 'About Us',
                                            'blog' => 'Resources',
                                            'careers' => 'Careers',
                                            'contact' => 'Contact',
                                        ];
                                        if (isset($labels[$state])) {
                                            $set('label', $labels[$state]);
                                        }
                                    }),

                                TextInput::make('label')
                                    ->label('Display Text')
                                    ->required()
                                    ->placeholder('e.g., Solutions'),

                                TextInput::make('url')
                                    ->label('Custom URL')
                                    ->visible(fn ($get) => $get('page') === 'custom')
                                    ->placeholder('/custom or https://...')
                                    ->required(fn ($get) => $get('page') === 'custom'),

                                Toggle::make('is_visible')
                                    ->label('Visible')
                                    ->default(true),
                            ])
                            ->columns(4)
                            ->collapsible()
                            ->itemLabel(fn (array $state): ?string => $state['label'] ?? null)
                            ->addActionLabel('Add Menu Link')
                            ->reorderableWithButtons(),
                    ]),

                // 2. Homepage Hero Architectural Banner
                Section::make('Homepage Hero Section (Architectural Banner)')
                    ->description('Adjust the primary architectural headline, heritage pill badge, and call-to-action buttons.')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('hero_pill_badge')
                                    ->label('Heritage Pill Badge (Gold)')
                                    ->placeholder('85+ Years Heritage')
                                    ->required(),

                                TextInput::make('hero_pill_text')
                                    ->label('Heritage Pill Subtitle')
                                    ->placeholder('Specialized Tensile & Lightweight Contractor')
                                    ->required(),
                            ]),

                        Textarea::make('hero_title')
                            ->label('Hero Main Title (H1)')
                            ->rows(2)
                            ->helperText('You may use <br> for line breaks.')
                            ->required(),

                        Textarea::make('hero_subtitle')
                            ->label('Hero Subtitle')
                            ->rows(3)
                            ->required(),

                        Grid::make(4)
                            ->schema([
                                TextInput::make('hero_btn1_text')
                                    ->label('Button 1 Text')
                                    ->placeholder('Our Solutions')
                                    ->required(),

                                TextInput::make('hero_btn1_url')
                                    ->label('Button 1 Target URL')
                                    ->placeholder('#solutions')
                                    ->required(),

                                TextInput::make('hero_btn2_text')
                                    ->label('Button 2 Text')
                                    ->placeholder('View Projects')
                                    ->required(),

                                TextInput::make('hero_btn2_url')
                                    ->label('Button 2 Target URL')
                                    ->placeholder('/projects')
                                    ->required(),
                            ]),
                    ]),

                // 3. Floating ASATI Partnership Card
                Section::make('Floating ASATI Partnership Alliance Card')
                    ->description('Edit the strategic regional partnership card on the right side of the hero section.')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('hero_asati_badge')
                                    ->label('Alliance Badge')
                                    ->placeholder('Strategic Regional Alliance')
                                    ->required(),

                                TextInput::make('hero_asati_title')
                                    ->label('Card Heading')
                                    ->placeholder('Delivering Air-Supported Structures Across MENA')
                                    ->required(),
                            ]),

                        Textarea::make('hero_asati_desc')
                            ->label('Partnership Narrative')
                            ->rows(3)
                            ->required(),

                        Grid::make(3)
                            ->schema([
                                TextInput::make('hero_asati_spec1_val')
                                    ->label('Spec 1 Value')
                                    ->placeholder('150m+')
                                    ->required(),

                                TextInput::make('hero_asati_spec1_label')
                                    ->label('Spec 1 Label')
                                    ->placeholder('Clear Span')
                                    ->required(),

                                TextInput::make('hero_asati_spec2_val')
                                    ->label('Spec 2 Value')
                                    ->placeholder('HVAC')
                                    ->required(),

                                TextInput::make('hero_asati_spec2_label')
                                    ->label('Spec 2 Label')
                                    ->placeholder('Climate Control')
                                    ->required(),

                                TextInput::make('hero_asati_spec3_val')
                                    ->label('Spec 3 Value')
                                    ->placeholder('Rapid')
                                    ->required(),

                                TextInput::make('hero_asati_spec3_label')
                                    ->label('Spec 3 Label')
                                    ->placeholder('Turnkey Erection')
                                    ->required(),
                            ]),

                        Grid::make(2)
                            ->schema([
                                TextInput::make('hero_asati_link_text')
                                    ->label('Action Link Text')
                                    ->placeholder('Learn More About ASATI Air Domes')
                                    ->required(),

                                TextInput::make('hero_asati_link_url')
                                    ->label('Action Link Target')
                                    ->placeholder('/solutions#air-supported')
                                    ->required(),
                            ]),
                    ]),

                // 4. 5-Column Trust Metrics & Heritage Bar
                Section::make('5-Column Trust Metrics & Heritage Bar')
                    ->description('Configure the 5 numerical proof points displayed right below the hero banner.')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                TextInput::make('stat_1_val')->label('Metric 1 Value')->placeholder('85+')->required(),
                                TextInput::make('stat_1_label')->label('Metric 1 Label')->placeholder('Years of Heritage')->required(),
                                TextInput::make('stat_1_sub')->label('Metric 1 Subtitle')->placeholder('Originated in 1937')->required(),
                            ]),

                        Grid::make(3)
                            ->schema([
                                TextInput::make('stat_2_val')->label('Metric 2 Value')->placeholder('9,000+')->required(),
                                TextInput::make('stat_2_label')->label('Metric 2 Label')->placeholder('Projects Delivered')->required(),
                                TextInput::make('stat_2_sub')->label('Metric 2 Subtitle')->placeholder('Proven Global Track Record')->required(),
                            ]),

                        Grid::make(3)
                            ->schema([
                                TextInput::make('stat_3_val')->label('Metric 3 Value')->placeholder('30+')->required(),
                                TextInput::make('stat_3_label')->label('Metric 3 Label')->placeholder('Countries Served')->required(),
                                TextInput::make('stat_3_sub')->label('Metric 3 Subtitle')->placeholder('Middle East, Africa & Beyond')->required(),
                            ]),

                        Grid::make(3)
                            ->schema([
                                TextInput::make('stat_4_val')->label('Metric 4 Value')->placeholder('End-to-End')->required(),
                                TextInput::make('stat_4_label')->label('Metric 4 Label')->placeholder('Turnkey Solutions')->required(),
                                TextInput::make('stat_4_sub')->label('Metric 4 Subtitle')->placeholder('From Design to Lifecycle AMC')->required(),
                            ]),

                        Grid::make(3)
                            ->schema([
                                TextInput::make('stat_5_val')->label('Metric 5 Value')->placeholder('ISO Certified')->required(),
                                TextInput::make('stat_5_label')->label('Metric 5 Label')->placeholder('Safety, Quality & Eco')->required(),
                                TextInput::make('stat_5_sub')->label('Metric 5 Subtitle')->placeholder('ISO 9001 | 14001 | 45001')->required(),
                            ]),
                    ])
                    ->collapsible(),
            ])
            ->statePath('data');
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label('Save Header & Hero Settings')
                ->submit('save')
                ->icon('heroicon-o-check-circle')
                ->color('primary'),
        ];
    }

    public function save(): void
    {
        $state = $this->form->getState();

        // 1. Top Navbar
        Setting::set('header_heritage_line1', $state['header_heritage_line1'] ?? '');
        Setting::set('header_heritage_line2', $state['header_heritage_line2'] ?? '');
        Setting::set('header_cta_text', $state['header_cta_text'] ?? '');
        Setting::set('header_cta_url', $state['header_cta_url'] ?? '');
        Setting::set('header_cta_visible', $state['header_cta_visible'] ?? true);
        Setting::set('header_nav_menu', json_encode(array_values($state['header_nav_menu'] ?? [])));

        // 2. Homepage Hero Banner
        Setting::set('hero_pill_badge', $state['hero_pill_badge'] ?? '');
        Setting::set('hero_pill_text', $state['hero_pill_text'] ?? '');
        Setting::set('hero_title', $state['hero_title'] ?? '');
        Setting::set('hero_subtitle', $state['hero_subtitle'] ?? '');
        Setting::set('hero_btn1_text', $state['hero_btn1_text'] ?? '');
        Setting::set('hero_btn1_url', $state['hero_btn1_url'] ?? '');
        Setting::set('hero_btn2_text', $state['hero_btn2_text'] ?? '');
        Setting::set('hero_btn2_url', $state['hero_btn2_url'] ?? '');

        // 3. ASATI Partnership Card
        Setting::set('hero_asati_badge', $state['hero_asati_badge'] ?? '');
        Setting::set('hero_asati_title', $state['hero_asati_title'] ?? '');
        Setting::set('hero_asati_desc', $state['hero_asati_desc'] ?? '');
        Setting::set('hero_asati_spec1_val', $state['hero_asati_spec1_val'] ?? '');
        Setting::set('hero_asati_spec1_label', $state['hero_asati_spec1_label'] ?? '');
        Setting::set('hero_asati_spec2_val', $state['hero_asati_spec2_val'] ?? '');
        Setting::set('hero_asati_spec2_label', $state['hero_asati_spec2_label'] ?? '');
        Setting::set('hero_asati_spec3_val', $state['hero_asati_spec3_val'] ?? '');
        Setting::set('hero_asati_spec3_label', $state['hero_asati_spec3_label'] ?? '');
        Setting::set('hero_asati_link_text', $state['hero_asati_link_text'] ?? '');
        Setting::set('hero_asati_link_url', $state['hero_asati_link_url'] ?? '');

        // 4. Trust Stats
        Setting::set('stat_1_val', $state['stat_1_val'] ?? '');
        Setting::set('stat_1_label', $state['stat_1_label'] ?? '');
        Setting::set('stat_1_sub', $state['stat_1_sub'] ?? '');

        Setting::set('stat_2_val', $state['stat_2_val'] ?? '');
        Setting::set('stat_2_label', $state['stat_2_label'] ?? '');
        Setting::set('stat_2_sub', $state['stat_2_sub'] ?? '');

        Setting::set('stat_3_val', $state['stat_3_val'] ?? '');
        Setting::set('stat_3_label', $state['stat_3_label'] ?? '');
        Setting::set('stat_3_sub', $state['stat_3_sub'] ?? '');

        Setting::set('stat_4_val', $state['stat_4_val'] ?? '');
        Setting::set('stat_4_label', $state['stat_4_label'] ?? '');
        Setting::set('stat_4_sub', $state['stat_4_sub'] ?? '');

        Setting::set('stat_5_val', $state['stat_5_val'] ?? '');
        Setting::set('stat_5_label', $state['stat_5_label'] ?? '');
        Setting::set('stat_5_sub', $state['stat_5_sub'] ?? '');

        Notification::make()
            ->title('Header & Hero settings saved successfully')
            ->body('The public website header and hero banner have been updated with your latest changes.')
            ->success()
            ->send();
    }
}
