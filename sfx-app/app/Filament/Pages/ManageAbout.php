<?php

namespace App\Filament\Pages;

use App\Models\Setting;
use Filament\Actions\Action;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class ManageAbout extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-information-circle';

    protected static ?string $navigationGroup = 'Site Settings & Branding';

    protected static ?string $navigationLabel = 'About Us Page';

    protected static ?string $title = 'About Us Page Content Management';

    protected static ?int $navigationSort = 4;

    protected static string $view = 'filament.pages.manage-about';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill([
            // 1. Hero Banner
            'about_hero_tag' => Setting::get('about_hero_tag', 'A Heritage of Engineering Excellence'),
            'about_hero_title' => Setting::get('about_hero_title', 'Pioneering Tensile Architecture Since 1937'),
            'about_hero_subtitle' => Setting::get('about_hero_subtitle', 'Specialized in turnkey engineering, manufacturing, and construction of iconic tensile membrane structures, PTFE canopies, and ETFE daylighting systems across the Middle East, Africa, and beyond.'),

            // 2. Company Narrative & Heritage
            'about_narrative_tag' => Setting::get('about_narrative_tag', 'Our Proven Heritage'),
            'about_narrative_title' => Setting::get('about_narrative_title', 'From Humble Sail-Making Roots to Global Tensile Mastery'),
            'about_narrative_p1' => Setting::get('about_narrative_p1', 'From humble sail-making beginnings, Structurflex began life as Sails & Covers Ltd on 21 July 1937. Across more than eight decades, Structurflex has consistently pursued innovation, developing proprietary fabrication techniques to become one of the world\'s leading suppliers of innovative tensile membrane structures.'),
            'about_narrative_p2' => Setting::get('about_narrative_p2', 'In 2005, Structurflex Middle East Contracting LLC was established in Dubai, United Arab Emirates as regional representative operations for the Structurflex Group to pursue the rapidly expanding demand in the MENA region for complex tensioned membrane architecture.'),
            'about_narrative_p3' => Setting::get('about_narrative_p3', 'In 2012, management responsibility of Structurflex Middle East Contracting LLC moved to Mr. Maged Mounir, ushering in a transformative era of regional expansion, federal contracting awards, and prestigious international commissions.'),

            // Feature Highlights
            'about_feature1_title' => Setting::get('about_feature1_title', 'Turnkey Engineering'),
            'about_feature1_desc' => Setting::get('about_feature1_desc', 'Parametric 3D form-finding, non-linear FEA, and structural wind tunnel simulations.'),
            'about_feature2_title' => Setting::get('about_feature2_title', 'Cleanroom Fabrication'),
            'about_feature2_desc' => Setting::get('about_feature2_desc', 'Automated CNC plotting and high-frequency (HF) molecular seaming for PVC, PTFE & ETFE.'),

            // Landmark Case Card
            'about_case_image' => Setting::get('about_case_image', 'assets/images/projects/al-jamea-etfe.png'),
            'about_case_badge' => Setting::get('about_case_badge', 'Landmark Project Case'),
            'about_case_title' => Setting::get('about_case_title', 'Al Jamea Tus Saifiyah (Nairobi, Kenya)'),
            'about_case_desc' => Setting::get('about_case_desc', 'Single Skin ETFE Tensile Membrane Roof engineered and constructed by Structurflex Middle East Contracting LLC.'),

            // 3. Managing Partner's Message
            'about_message_tag' => Setting::get('about_message_tag', 'Executive Leadership'),
            'about_message_title' => Setting::get('about_message_title', 'Managing Partner\'s Message'),
            'about_message_quote' => Setting::get('about_message_quote', "At Structurflex ME, the health and safety of our colleagues, customers, partners, and communities remains our topmost priority. We understand that meeting our customer's requirements is crucial to the success of our organization, and we have worked diligently to ensure that our clients receive exceptional service.\n\nFurthermore, we remain steadfast in our commitment to environmental awareness and sustainability. As we strive to prevent climate change and resource depletion, we recognize the importance of preserving the environment for future generations. We remain committed to providing innovative and customized solutions to meet your needs, while contributing to the growth and development of our industry."),
            'about_leader_name' => Setting::get('about_leader_name', 'Mr. Maged Mounir'),
            'about_leader_title' => Setting::get('about_leader_title', 'Managing Partner, Structurflex Middle East Contracting LLC'),
            'about_leader_badge' => Setting::get('about_leader_badge', 'Strategic Partner of Ministry of Public Works'),

            // 4. Strategic Recognition / Award
            'about_award_image' => Setting::get('about_award_image', 'assets/images/credentials/ministry-public-works-award.png'),
            'about_award_caption' => Setting::get('about_award_caption', 'Official UAE Ministry of Public Works Award'),
            'about_award_tag' => Setting::get('about_award_tag', 'Strategic Recognition'),
            'about_award_title' => Setting::get('about_award_title', 'Ministry of Public Works Strategic Partner Award'),
            'about_award_p1' => Setting::get('about_award_p1', 'Structurflex Middle East Contracting LLC was formally honored by the United Arab Emirates Ministry of Public Works on Tuesday, 17th June 2014 as one of the strategic partners collaborating in achieving the ministry\'s national infrastructure vision.'),
            'about_award_p2' => Setting::get('about_award_p2', 'Structurflex Middle East has successfully engineered and executed 14 successful projects with the Ministry of Public Works since 2007, establishing an unblemished record for high-precision tensile engineering, structural safety, and durability.'),
            'about_award_btn_text' => Setting::get('about_award_btn_text', 'Partner With Our UAE Practice'),
            'about_award_btn_url' => Setting::get('about_award_btn_url', '/contact'),
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                // SECTION 1: HERO BANNER
                Section::make('Page Hero Banner')
                    ->description('Controls the top introduction banner of the About Us page.')
                    ->icon('heroicon-o-sparkles')
                    ->collapsible()
                    ->schema([
                        Grid::make(12)->schema([
                            TextInput::make('about_hero_tag')
                                ->label('Hero Badge / Tag')
                                ->required()
                                ->columnSpan(4),

                            TextInput::make('about_hero_title')
                                ->label('Main Banner Headline (H1)')
                                ->required()
                                ->columnSpan(8),

                            Textarea::make('about_hero_subtitle')
                                ->label('Hero Subtitle / Mission Statement')
                                ->rows(3)
                                ->required()
                                ->columnSpan(12),
                        ]),
                    ]),

                // SECTION 2: COMPANY NARRATIVE & HERITAGE
                Section::make('Heritage & History Narrative')
                    ->description('Detailed chronicle of Structurflex founding (1937) and regional UAE operations.')
                    ->icon('heroicon-o-clock')
                    ->collapsible()
                    ->schema([
                        Grid::make(12)->schema([
                            TextInput::make('about_narrative_tag')
                                ->label('Section Tag')
                                ->required()
                                ->columnSpan(4),

                            TextInput::make('about_narrative_title')
                                ->label('Section Headline (H2)')
                                ->required()
                                ->columnSpan(8),

                            Textarea::make('about_narrative_p1')
                                ->label('Founding Heritage (1937 Sail-making roots)')
                                ->rows(3)
                                ->required()
                                ->columnSpan(12),

                            Textarea::make('about_narrative_p2')
                                ->label('Dubai Establishment (2005 MENA representative office)')
                                ->rows(3)
                                ->required()
                                ->columnSpan(12),

                            Textarea::make('about_narrative_p3')
                                ->label('Regional Leadership (2012 onwards)')
                                ->rows(3)
                                ->required()
                                ->columnSpan(12),

                            TextInput::make('about_feature1_title')
                                ->label('Feature 1 Title')
                                ->required()
                                ->columnSpan(6),

                            TextInput::make('about_feature1_desc')
                                ->label('Feature 1 Description')
                                ->required()
                                ->columnSpan(6),

                            TextInput::make('about_feature2_title')
                                ->label('Feature 2 Title')
                                ->required()
                                ->columnSpan(6),

                            TextInput::make('about_feature2_desc')
                                ->label('Feature 2 Description')
                                ->required()
                                ->columnSpan(6),
                        ]),

                        Section::make('Landmark Case Callout Card')
                            ->compact()
                            ->schema([
                                Grid::make(12)->schema([
                                    TextInput::make('about_case_image')
                                        ->label('Image Relative Path or URL')
                                        ->required()
                                        ->columnSpan(6),

                                    TextInput::make('about_case_badge')
                                        ->label('Card Badge')
                                        ->required()
                                        ->columnSpan(6),

                                    TextInput::make('about_case_title')
                                        ->label('Landmark Project Title')
                                        ->required()
                                        ->columnSpan(6),

                                    TextInput::make('about_case_desc')
                                        ->label('Short Description')
                                        ->required()
                                        ->columnSpan(6),
                                ]),
                            ]),
                    ]),

                // SECTION 3: MANAGING PARTNER'S MESSAGE
                Section::make('Managing Partner\'s Message')
                    ->description('Official statement from executive leadership on safety, sustainability, and quality.')
                    ->icon('heroicon-o-chat-bubble-bottom-center-text')
                    ->collapsible()
                    ->schema([
                        Grid::make(12)->schema([
                            TextInput::make('about_message_tag')
                                ->label('Badge Tag')
                                ->required()
                                ->columnSpan(4),

                            TextInput::make('about_message_title')
                                ->label('Message Card Title')
                                ->required()
                                ->columnSpan(8),

                            Textarea::make('about_message_quote')
                                ->label('Leader Message Quote Body')
                                ->rows(6)
                                ->required()
                                ->columnSpan(12),

                            TextInput::make('about_leader_name')
                                ->label('Leader Full Name')
                                ->required()
                                ->columnSpan(4),

                            TextInput::make('about_leader_title')
                                ->label('Leader Official Title')
                                ->required()
                                ->columnSpan(4),

                            TextInput::make('about_leader_badge')
                                ->label('Accreditation Tag')
                                ->required()
                                ->columnSpan(4),
                        ]),
                    ]),

                // SECTION 4: STRATEGIC RECOGNITION / AWARD
                Section::make('Strategic Recognition (Ministry of Public Works Award)')
                    ->description('UAE Ministry of Public Works Strategic Partner Award presentation details.')
                    ->icon('heroicon-o-trophy')
                    ->collapsible()
                    ->schema([
                        Grid::make(12)->schema([
                            TextInput::make('about_award_image')
                                ->label('Award Photo Path or URL')
                                ->required()
                                ->columnSpan(6),

                            TextInput::make('about_award_caption')
                                ->label('Photo Caption')
                                ->required()
                                ->columnSpan(6),

                            TextInput::make('about_award_tag')
                                ->label('Section Tag')
                                ->required()
                                ->columnSpan(4),

                            TextInput::make('about_award_title')
                                ->label('Award Title')
                                ->required()
                                ->columnSpan(8),

                            Textarea::make('about_award_p1')
                                ->label('Formal Honor Paragraph')
                                ->rows(3)
                                ->required()
                                ->columnSpan(12),

                            Textarea::make('about_award_p2')
                                ->label('Track Record Paragraph (14 Projects since 2007)')
                                ->rows(3)
                                ->required()
                                ->columnSpan(12),

                            TextInput::make('about_award_btn_text')
                                ->label('CTA Button Text')
                                ->required()
                                ->columnSpan(6),

                            TextInput::make('about_award_btn_url')
                                ->label('CTA Button URL')
                                ->required()
                                ->columnSpan(6),
                        ]),
                    ]),
            ])
            ->statePath('data');
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label('Save About Us Page')
                ->submit('save')
                ->icon('heroicon-o-check-circle')
                ->color('primary'),
        ];
    }

    public function save(): void
    {
        $state = $this->form->getState();

        foreach ($state as $key => $value) {
            Setting::set($key, $value);
        }

        Notification::make()
            ->title('About Us page updated successfully')
            ->body('All modifications to the About Us page are now live.')
            ->success()
            ->send();
    }
}
