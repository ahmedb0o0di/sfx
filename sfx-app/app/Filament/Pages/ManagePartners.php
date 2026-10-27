<?php

namespace App\Filament\Pages;

use App\Models\Setting;
use Filament\Actions\Action;
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

class ManagePartners extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';

    protected static ?string $navigationGroup = 'Site Settings & Branding';

    protected static ?string $navigationLabel = 'Clients & Partners';

    protected static ?string $title = 'Trusted Clients, Partners & Credentials Management';

    protected static ?int $navigationSort = 3;

    protected static string $view = 'filament.pages.manage-partners';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill([
            'partners_section_visible' => (bool) Setting::get('partners_section_visible', true),
            'partners_section_tag' => Setting::get('partners_section_tag', 'Trust & Alliances'),
            'partners_section_title' => Setting::get('partners_section_title', 'TRUSTED BY LEADING CLIENTS & PARTNERS'),
            'partners_section_subtitle' => Setting::get('partners_section_subtitle', 'Collaborating with government ministries, master developers, and international engineering leaders.'),
            'partners_items' => $this->getInitialPartnersItems(),

            'certifications_section_visible' => (bool) Setting::get('certifications_section_visible', true),
            'certifications_items' => $this->getInitialCertificationsItems(),
        ]);
    }

    protected function getInitialPartnersItems(): array
    {
        $saved = Setting::get('partners_items');
        if ($saved) {
            $decoded = json_decode($saved, true);
            if (is_array($decoded) && count($decoded) > 0) {
                return $decoded;
            }
        }

        return [
            [
                'name' => 'ASATI',
                'subtitle' => 'Air Structures American Technologies',
                'link_url' => '',
                'is_visible' => true,
            ],
            [
                'name' => 'Ministry of Public Works',
                'subtitle' => 'Strategic Partner (14 Projects)',
                'link_url' => '',
                'is_visible' => true,
            ],
            [
                'name' => 'RTA Dubai',
                'subtitle' => 'Roads & Transport Authority',
                'link_url' => '',
                'is_visible' => true,
            ],
            [
                'name' => 'Oromia Regional Govt',
                'subtitle' => 'Unity Park Project',
                'link_url' => '',
                'is_visible' => true,
            ],
            [
                'name' => 'Nakheel & Emaar',
                'subtitle' => 'Master Developers',
                'link_url' => '',
                'is_visible' => true,
            ],
            [
                'name' => 'Al Ain Municipality',
                'subtitle' => 'Civic Architectural Projects',
                'link_url' => '',
                'is_visible' => true,
            ],
        ];
    }

    protected function getInitialCertificationsItems(): array
    {
        $saved = Setting::get('certifications_items');
        if ($saved) {
            $decoded = json_decode($saved, true);
            if (is_array($decoded) && count($decoded) > 0) {
                return $decoded;
            }
        }

        return [
            [
                'title' => 'ISO 9001:2015',
                'description' => 'Quality Management System Certification across design, fabrication & erection.',
                'icon' => 'shield',
                'accent_border' => false,
                'is_visible' => true,
            ],
            [
                'title' => 'ISO 14001:2015',
                'description' => 'Environmental Management System ensuring sustainable lifecycle practices.',
                'icon' => 'globe',
                'accent_border' => false,
                'is_visible' => true,
            ],
            [
                'title' => 'ISO 45001:2018',
                'description' => 'Occupational Health & Safety certified for high-altitude tension rigging.',
                'icon' => 'heart',
                'accent_border' => false,
                'is_visible' => true,
            ],
            [
                'title' => 'Ministry Award',
                'description' => 'Special Strategic Partner Award from UAE Ministry of Public Works (14 successful projects).',
                'icon' => 'award',
                'accent_border' => true,
                'is_visible' => true,
            ],
        ];
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Trusted Clients & Strategic Partners')
                    ->description('Manage the prominent client and partner alliance badges displayed on the homepage.')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                TextInput::make('partners_section_tag')
                                    ->label('Section Badge / Tag')
                                    ->placeholder('Trust & Alliances')
                                    ->required()
                                    ->columnSpan(2),

                                Toggle::make('partners_section_visible')
                                    ->label('Show Partners Grid')
                                    ->default(true),
                            ]),

                        TextInput::make('partners_section_title')
                            ->label('Section Main Title (H2)')
                            ->placeholder('TRUSTED BY LEADING CLIENTS & PARTNERS')
                            ->required(),

                        Textarea::make('partners_section_subtitle')
                            ->label('Section Subtitle')
                            ->rows(2)
                            ->placeholder('Collaborating with government ministries, master developers, and international engineering leaders.')
                            ->required(),

                        Repeater::make('partners_items')
                            ->label('Partner & Client Badges')
                            ->helperText('Manage each partner organization badge in the matrix grid (reorder, edit names, subtitles, or links).')
                            ->schema([
                                Grid::make(12)
                                    ->schema([
                                        TextInput::make('name')
                                            ->label('Organization / Client Name')
                                            ->placeholder('e.g. ASATI, RTA Dubai, Nakheel')
                                            ->required()
                                            ->columnSpan(5),

                                        TextInput::make('subtitle')
                                            ->label('Subtitle / Project Note')
                                            ->placeholder('e.g. Strategic Partner (14 Projects)')
                                            ->columnSpan(4),

                                        Toggle::make('is_visible')
                                            ->label('Visible')
                                            ->default(true)
                                            ->columnSpan(3),

                                        TextInput::make('link_url')
                                            ->label('Website / Case Study URL (Optional)')
                                            ->placeholder('https://...')
                                            ->columnSpan(12),
                                    ]),
                            ])
                            ->collapsible()
                            ->itemLabel(fn (array $state): ?string => $state['name'] ?? 'Partner Item')
                            ->addActionLabel('Add Partner / Client')
                            ->reorderableWithButtons(),
                    ]),

                Section::make('Accreditations & Quality Certifications')
                    ->description('Configure the ISO certifications and Ministry awards displayed below the partner grid.')
                    ->schema([
                        Toggle::make('certifications_section_visible')
                            ->label('Show Certifications & Accreditations Row')
                            ->default(true),

                        Repeater::make('certifications_items')
                            ->label('Certification & Award Cards')
                            ->schema([
                                Grid::make(12)
                                    ->schema([
                                        TextInput::make('title')
                                            ->label('Certification Title / Award')
                                            ->placeholder('e.g. ISO 9001:2015, Ministry Award')
                                            ->required()
                                            ->columnSpan(4),

                                        Select::make('icon')
                                            ->label('Icon')
                                            ->options([
                                                'shield' => 'Shield (Quality / Assurance)',
                                                'globe' => 'Globe (Environmental / Global)',
                                                'heart' => 'Heart / Safety (HSE & Wellbeing)',
                                                'award' => 'Award Ribbon (Recognition / Medal)',
                                                'star' => 'Star (Excellence)',
                                            ])
                                            ->default('shield')
                                            ->required()
                                            ->columnSpan(3),

                                        Toggle::make('accent_border')
                                            ->label('Gold Accent Border')
                                            ->helperText('Highlight this credential with an amber/gold border and badge')
                                            ->default(false)
                                            ->columnSpan(3),

                                        Toggle::make('is_visible')
                                            ->label('Visible')
                                            ->default(true)
                                            ->columnSpan(2),

                                        Textarea::make('description')
                                            ->label('Description / Scope')
                                            ->rows(2)
                                            ->placeholder('Certification scope details...')
                                            ->required()
                                            ->columnSpan(12),
                                    ]),
                            ])
                            ->collapsible()
                            ->itemLabel(fn (array $state): ?string => $state['title'] ?? 'Certification Card')
                            ->addActionLabel('Add Certification Card')
                            ->reorderableWithButtons(),
                    ]),
            ])
            ->statePath('data');
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label('Save Clients & Partners Settings')
                ->submit('save')
                ->icon('heroicon-o-check-circle')
                ->color('primary'),
        ];
    }

    public function save(): void
    {
        $state = $this->form->getState();

        Setting::set('partners_section_visible', $state['partners_section_visible'] ?? true);
        Setting::set('partners_section_tag', $state['partners_section_tag'] ?? '');
        Setting::set('partners_section_title', $state['partners_section_title'] ?? '');
        Setting::set('partners_section_subtitle', $state['partners_section_subtitle'] ?? '');
        Setting::set('partners_items', json_encode(array_values($state['partners_items'] ?? [])));

        Setting::set('certifications_section_visible', $state['certifications_section_visible'] ?? true);
        Setting::set('certifications_items', json_encode(array_values($state['certifications_items'] ?? [])));

        Notification::make()
            ->title('Clients, Partners & Credentials saved successfully')
            ->body('The TRUSTED BY LEADING CLIENTS & PARTNERS section on the homepage has been updated.')
            ->success()
            ->send();
    }
}
