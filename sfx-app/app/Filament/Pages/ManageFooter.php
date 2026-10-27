<?php

namespace App\Filament\Pages;

use App\Models\Project;
use App\Models\Setting;
use Filament\Actions\Action;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class ManageFooter extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-queue-list';

    protected static ?string $navigationGroup = 'Site Settings & Branding';

    protected static ?string $navigationLabel = 'Footer Management';

    protected static ?string $title = 'Footer Settings & Navigation';

    protected static ?int $navigationSort = 3;

    protected static string $view = 'filament.pages.manage-footer';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill([
            // Column 1: Brand details
            'footer_brand_desc' => Setting::get('footer_brand_desc', 'From humble sail-making beginnings in 1937 (Sails & Covers Ltd) to a world leader in tensile membranes. Established in Dubai in 2005 as Structurflex Middle East Contracting LLC to engineer visionary spaces across MENA and Africa.'),
            
            // Social Media Channels
            'social_linkedin' => Setting::get('social_linkedin', 'https://www.linkedin.com/company/structurflex/'),
            'social_twitter' => Setting::get('social_twitter', Setting::get('social_x', 'https://x.com/structurflex')),
            'social_facebook' => Setting::get('social_facebook', ''),
            'social_instagram' => Setting::get('social_instagram', ''),
            'social_youtube' => Setting::get('social_youtube', ''),
            'social_whatsapp' => Setting::get('social_whatsapp', ''),
            'social_tiktok' => Setting::get('social_tiktok', ''),
            'social_pinterest' => Setting::get('social_pinterest', ''),

            // Column 2: Solutions links (selectable from Projects or custom)
            'footer_solutions' => $this->getInitialSolutions(),

            // Column 3: Company links (selectable pages or custom)
            'footer_company_links' => $this->getInitialCompanyLinks(),

            // Column 4: Get In Touch information
            'footer_address' => Setting::get('footer_address', Setting::get('factory_address', 'Shed 01 (S-464), Al Ttay Area, Al Khawaneej 2 Industrial Area, Dubai, UAE')),
            'footer_phone' => Setting::get('footer_phone', Setting::get('dubai_phone', '+971 4 238 8455')),
            'footer_email' => Setting::get('footer_email', Setting::get('general_email', 'info@structurflex.ae')),
            'footer_website' => Setting::get('footer_website', Setting::get('website_url', 'www.structurflex.ae')),

            // 5 Outcomes messages below the footer
            'footer_outcome_1' => Setting::get('footer_outcome_1', 'Stronger Brand Positioning'),
            'footer_outcome_2' => Setting::get('footer_outcome_2', 'Increased Trust & Credibility'),
            'footer_outcome_3' => Setting::get('footer_outcome_3', 'Higher Quality Leads'),
            'footer_outcome_4' => Setting::get('footer_outcome_4', 'Improved Conversion Rate'),
            'footer_outcome_5' => Setting::get('footer_outcome_5', 'Supporting Business Growth'),

            // Sub-Footer copyright notice
            'footer_copyright' => Setting::get('footer_copyright', 'Structurflex Middle East Contracting LLC. All rights reserved.'),
        ]);
    }

    protected function getInitialSolutions(): array
    {
        $saved = Setting::get('footer_solutions');
        if ($saved) {
            $decoded = json_decode($saved, true);
            if (is_array($decoded) && count($decoded) > 0) {
                return $decoded;
            }
        }

        return [
            ['link_type' => 'custom', 'label' => 'Architectural Structures', 'custom_url' => '/solutions#architectural', 'project_id' => null],
            ['link_type' => 'custom', 'label' => 'Sports & Recreation', 'custom_url' => '/solutions#sports', 'project_id' => null],
            ['link_type' => 'custom', 'label' => 'Commercial & Retail', 'custom_url' => '/solutions#commercial', 'project_id' => null],
            ['link_type' => 'custom', 'label' => 'Transport & Infrastructure', 'custom_url' => '/solutions#transport', 'project_id' => null],
            ['link_type' => 'custom', 'label' => 'Industrial & Warehouse', 'custom_url' => '/solutions#industrial', 'project_id' => null],
            ['link_type' => 'custom', 'label' => 'Air-Supported Domes (ASATI)', 'custom_url' => '/solutions#air-supported', 'project_id' => null],
            ['link_type' => 'custom', 'label' => 'Lifecycle Services (AMC)', 'custom_url' => '/solutions#lifecycle', 'project_id' => null],
        ];
    }

    protected function getInitialCompanyLinks(): array
    {
        $saved = Setting::get('footer_company_links');
        if ($saved) {
            $decoded = json_decode($saved, true);
            if (is_array($decoded) && count($decoded) > 0) {
                return $decoded;
            }
        }

        return [
            ['page' => 'about', 'label' => 'About Structurflex ME', 'custom_url' => null],
            ['page' => 'projects', 'label' => 'Featured Projects', 'custom_url' => null],
            ['page' => 'capabilities', 'label' => 'Our Capabilities', 'custom_url' => null],
            ['page' => 'credentials', 'label' => 'ISO Certifications', 'custom_url' => null],
            ['page' => 'blog', 'label' => 'Insights & Resources', 'custom_url' => null],
            ['page' => 'careers', 'label' => 'Careers & Practice', 'custom_url' => null],
            ['page' => 'contact', 'label' => 'Contact Us', 'custom_url' => null],
        ];
    }

    public function form(Form $form): Form
    {
        $projectsList = Project::orderBy('title')->pluck('title', 'id')->toArray();

        return $form
            ->schema([
                // Section 1: Column 2 - Solutions & Project Links
                Section::make('Column 2: Solutions Navigation (Selectable from Projects)')
                    ->description('Choose whether each link points to a project from your database or a custom solutions URL.')
                    ->schema([
                        Repeater::make('footer_solutions')
                            ->label('Solutions Links')
                            ->schema([
                                Select::make('link_type')
                                    ->label('Link Source')
                                    ->options([
                                        'project' => 'Select From Projects',
                                        'custom' => 'Custom Solutions / Page URL',
                                    ])
                                    ->default('project')
                                    ->required()
                                    ->reactive()
                                    ->afterStateUpdated(function ($state, callable $set, callable $get) use ($projectsList) {
                                        if ($state === 'project' && $get('project_id') && isset($projectsList[$get('project_id')])) {
                                            $set('label', $projectsList[$get('project_id')]);
                                        }
                                    }),

                                Select::make('project_id')
                                    ->label('Choose Project')
                                    ->options($projectsList)
                                    ->searchable()
                                    ->visible(fn ($get) => $get('link_type') === 'project')
                                    ->reactive()
                                    ->afterStateUpdated(function ($state, callable $set) use ($projectsList) {
                                        if ($state && isset($projectsList[$state])) {
                                            $set('label', $projectsList[$state]);
                                        }
                                    }),

                                TextInput::make('label')
                                    ->label('Display Title')
                                    ->required()
                                    ->placeholder('e.g., Al Jamea Single Skin ETFE'),

                                TextInput::make('custom_url')
                                    ->label('Destination URL')
                                    ->visible(fn ($get) => $get('link_type') === 'custom')
                                    ->placeholder('/solutions#architectural')
                                    ->required(fn ($get) => $get('link_type') === 'custom'),
                            ])
                            ->columns(3)
                            ->collapsible()
                            ->itemLabel(fn (array $state): ?string => $state['label'] ?? null)
                            ->addActionLabel('Add New Solution / Project Link')
                            ->reorderableWithButtons(),
                    ]),

                // Section 2: Column 3 - Company Links (Selectable Pages)
                Section::make('Column 3: Company Navigation (Selectable Pages)')
                    ->description('Select the target page for each company link from predefined website routes or enter a custom link.')
                    ->schema([
                        Repeater::make('footer_company_links')
                            ->label('Company Pages')
                            ->schema([
                                Select::make('page')
                                    ->label('Select Page')
                                    ->options([
                                        'about' => 'About Structurflex ME (/about)',
                                        'projects' => 'Featured Projects (/projects)',
                                        'capabilities' => 'Our Capabilities (/#capabilities)',
                                        'credentials' => 'ISO Certifications (/#credentials)',
                                        'blog' => 'Insights & Resources (/blog)',
                                        'careers' => 'Careers & Practice (/contact?inquiry=careers)',
                                        'contact' => 'Contact Us (/contact)',
                                        'privacy' => 'Privacy Policy (/privacy-policy)',
                                        'terms' => 'Terms of Service (/terms-conditions)',
                                        'custom' => 'Custom External or Internal URL',
                                    ])
                                    ->required()
                                    ->reactive()
                                    ->afterStateUpdated(function ($state, callable $set) {
                                        $map = [
                                            'about' => 'About Structurflex ME',
                                            'projects' => 'Featured Projects',
                                            'capabilities' => 'Our Capabilities',
                                            'credentials' => 'ISO Certifications',
                                            'blog' => 'Insights & Resources',
                                            'careers' => 'Careers & Practice',
                                            'contact' => 'Contact Us',
                                            'privacy' => 'Privacy Policy',
                                            'terms' => 'Terms of Service',
                                        ];
                                        if (isset($map[$state])) {
                                            $set('label', $map[$state]);
                                        }
                                    }),

                                TextInput::make('label')
                                    ->label('Link Title')
                                    ->required()
                                    ->placeholder('e.g., About Structurflex ME'),

                                TextInput::make('custom_url')
                                    ->label('Custom URL')
                                    ->visible(fn ($get) => $get('page') === 'custom')
                                    ->placeholder('https://example.com or /custom-page')
                                    ->required(fn ($get) => $get('page') === 'custom'),
                            ])
                            ->columns(3)
                            ->collapsible()
                            ->itemLabel(fn (array $state): ?string => $state['label'] ?? null)
                            ->addActionLabel('Add Company Link')
                            ->reorderableWithButtons(),
                    ]),

                // Section 3: Column 4 - Get In Touch Information
                Section::make('Column 4: Get In Touch Information')
                    ->description('Manage regional contact details shown in the 4th column of the footer. Leave any field blank to hide it on the frontend.')
                    ->schema([
                        TextInput::make('footer_address')
                            ->label('Factory / Regional Office Address')
                            ->placeholder('Shed 01 (S-464), Al Ttay Area, Al Khawaneej 2 Industrial Area, Dubai, UAE')
                            ->nullable()
                            ->columnSpanFull(),

                        Grid::make(3)
                            ->schema([
                                TextInput::make('footer_phone')
                                    ->label('Contact Phone / Landline')
                                    ->placeholder('+971 4 238 8455')
                                    ->nullable(),

                                TextInput::make('footer_email')
                                    ->label('Official Email')
                                    ->placeholder('info@structurflex.ae')
                                    ->email()
                                    ->nullable(),

                                TextInput::make('footer_website')
                                    ->label('Official Domain / Website')
                                    ->placeholder('www.structurflex.ae')
                                    ->nullable(),
                            ]),
                    ]),

                // Section 4: 5 Strategic Outcomes Messages Below The Footer
                Section::make('Strategic Outcomes Bar (5 Messages Below Footer)')
                    ->description('Adjust the 5 core value-proposition messages displayed in the ribbon below the footer columns. Empty messages are automatically hidden.')
                    ->schema([
                        Grid::make(5)
                            ->schema([
                                TextInput::make('footer_outcome_1')
                                    ->label('Message 1')
                                    ->placeholder('Stronger Brand Positioning')
                                    ->nullable(),

                                TextInput::make('footer_outcome_2')
                                    ->label('Message 2')
                                    ->placeholder('Increased Trust & Credibility')
                                    ->nullable(),

                                TextInput::make('footer_outcome_3')
                                    ->label('Message 3')
                                    ->placeholder('Higher Quality Leads')
                                    ->nullable(),

                                TextInput::make('footer_outcome_4')
                                    ->label('Message 4')
                                    ->placeholder('Improved Conversion Rate')
                                    ->nullable(),

                                TextInput::make('footer_outcome_5')
                                    ->label('Message 5')
                                    ->placeholder('Supporting Business Growth')
                                    ->nullable(),
                            ]),
                    ]),

                // Section 5: Brand Narrative, All Social Profiles & Sub-Footer
                Section::make('Brand Heritage, Social Media & Sub-Footer')
                    ->description('Update the brand intro statement in column 1, all social media channels, and the bottom copyright notice. Empty social links will automatically be hidden on the frontend.')
                    ->schema([
                        Textarea::make('footer_brand_desc')
                            ->label('Brand Heritage Summary (Col 1)')
                            ->placeholder('Describe company heritage...')
                            ->rows(3)
                            ->columnSpanFull()
                            ->nullable(),

                        Section::make('Social Media Profiles')
                            ->description('Provide profile or page URLs. Leave any platform blank to automatically hide its icon from the frontend footer.')
                            ->schema([
                                Grid::make(4)
                                    ->schema([
                                        TextInput::make('social_linkedin')
                                            ->label('LinkedIn')
                                            ->placeholder('https://linkedin.com/company/...')
                                            ->url()
                                            ->nullable(),

                                        TextInput::make('social_twitter')
                                            ->label('X')
                                            ->placeholder('https://x.com/...')
                                            ->url()
                                            ->nullable(),

                                        TextInput::make('social_facebook')
                                            ->label('Facebook')
                                            ->placeholder('https://facebook.com/...')
                                            ->url()
                                            ->nullable(),

                                        TextInput::make('social_instagram')
                                            ->label('Instagram')
                                            ->placeholder('https://instagram.com/...')
                                            ->url()
                                            ->nullable(),

                                        TextInput::make('social_youtube')
                                            ->label('YouTube')
                                            ->placeholder('https://youtube.com/@...')
                                            ->url()
                                            ->nullable(),

                                        TextInput::make('social_whatsapp')
                                            ->label('WhatsApp')
                                            ->placeholder('https://wa.me/971501234567')
                                            ->nullable(),

                                        TextInput::make('social_tiktok')
                                            ->label('TikTok')
                                            ->placeholder('https://tiktok.com/@...')
                                            ->url()
                                            ->nullable(),

                                        TextInput::make('social_pinterest')
                                            ->label('Pinterest')
                                            ->placeholder('https://pinterest.com/...')
                                            ->url()
                                            ->nullable(),
                                    ]),
                            ])
                            ->collapsible(),

                        TextInput::make('footer_copyright')
                            ->label('Copyright Notice')
                            ->placeholder('Structurflex Middle East Contracting LLC. All rights reserved.')
                            ->nullable()
                            ->columnSpanFull(),
                    ])
                    ->collapsible(),
            ])
            ->statePath('data');
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label('Save Footer Settings')
                ->submit('save')
                ->icon('heroicon-o-check-circle')
                ->color('primary'),
        ];
    }

    public function save(): void
    {
        $state = $this->form->getState();

        Setting::set('footer_brand_desc', $state['footer_brand_desc'] ?? '');

        // Save all social media links
        Setting::set('social_linkedin', $state['social_linkedin'] ?? '');
        Setting::set('social_twitter', $state['social_twitter'] ?? '');
        Setting::set('social_facebook', $state['social_facebook'] ?? '');
        Setting::set('social_instagram', $state['social_instagram'] ?? '');
        Setting::set('social_youtube', $state['social_youtube'] ?? '');
        Setting::set('social_whatsapp', $state['social_whatsapp'] ?? '');
        Setting::set('social_tiktok', $state['social_tiktok'] ?? '');
        Setting::set('social_pinterest', $state['social_pinterest'] ?? '');

        Setting::set('footer_solutions', json_encode(array_values($state['footer_solutions'] ?? [])));
        Setting::set('footer_company_links', json_encode(array_values($state['footer_company_links'] ?? [])));

        Setting::set('footer_address', $state['footer_address'] ?? '');
        Setting::set('factory_address', $state['footer_address'] ?? '');
        Setting::set('footer_phone', $state['footer_phone'] ?? '');
        Setting::set('dubai_phone', $state['footer_phone'] ?? '');
        Setting::set('footer_email', $state['footer_email'] ?? '');
        Setting::set('general_email', $state['footer_email'] ?? '');
        Setting::set('footer_website', $state['footer_website'] ?? '');
        Setting::set('website_url', $state['footer_website'] ?? '');

        Setting::set('footer_outcome_1', $state['footer_outcome_1'] ?? '');
        Setting::set('footer_outcome_2', $state['footer_outcome_2'] ?? '');
        Setting::set('footer_outcome_3', $state['footer_outcome_3'] ?? '');
        Setting::set('footer_outcome_4', $state['footer_outcome_4'] ?? '');
        Setting::set('footer_outcome_5', $state['footer_outcome_5'] ?? '');

        Setting::set('footer_copyright', $state['footer_copyright'] ?? '');

        Notification::make()
            ->title('Footer settings saved successfully')
            ->body('The public website footer has been updated with your latest changes.')
            ->success()
            ->send();
    }
}
