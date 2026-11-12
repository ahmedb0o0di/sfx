<?php

namespace App\Filament\Pages;

use App\Models\Setting;
use Filament\Actions\Action;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class ManageContact extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-phone';

    protected static ?string $navigationGroup = 'Site Settings & Branding';

    protected static ?string $navigationLabel = 'Contact & Offices';

    protected static ?string $title = 'Contact Information & Office Hubs';

    protected static ?int $navigationSort = 5;

    protected static string $view = 'filament.pages.manage-contact';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill([
            // Banner
            'contact_banner_tag' => Setting::get('contact_banner_tag', 'Direct Engineering Consultation'),
            'contact_banner_title' => Setting::get('contact_banner_title', 'Regional Engineering Hubs: Dubai & Cairo'),
            'contact_banner_subtitle' => Setting::get('contact_banner_subtitle', 'Connect directly with our structural engineering and commercial leadership in Dubai and Cairo for architectural form-finding, material specifications, and turnkey B2B budgeting.'),

            // Dubai HQ
            'dubai_office_title' => Setting::get('dubai_office_title', 'Dubai Regional Headquarters'),
            'dubai_address' => Setting::get('dubai_address', "Shed 01 (S-464), Al Ttay Area,\nAl Khawaneej 2 Industrial Area,\nDubai, United Arab Emirates"),
            'dubai_po_box' => Setting::get('dubai_po_box', 'P. O BOX: 98447'),
            'dubai_phone' => Setting::get('dubai_phone', '+971 4 238 8455'),
            'dubai_email' => Setting::get('dubai_email', 'dubai@structurflex.ae'),
            'general_email' => Setting::get('general_email', 'info@structurflex.ae'),
            'dubai_hours' => Setting::get('dubai_hours', 'Mon - Fri: 8:00 AM - 5:30 PM (GST)'),

            // Cairo Branch
            'cairo_office_title' => Setting::get('cairo_office_title', 'Cairo Regional Engineering Branch'),
            'cairo_address' => Setting::get('cairo_address', '5th Settlement, New Cairo, Egypt'),
            'cairo_phone' => Setting::get('cairo_phone', '+20 10 0000 0000'),
            'cairo_email' => Setting::get('cairo_email', 'cairo@structurflex.ae'),

            // WhatsApp Quick-Connect
            'whatsapp_number' => Setting::get('whatsapp_number', '971502959942'),
            'whatsapp_title' => Setting::get('whatsapp_title', 'Need Urgent Feasibility Assessment?'),
            'whatsapp_text' => Setting::get('whatsapp_text', 'Chat directly with our Dubai duty engineering team on WhatsApp.'),

            // Google Maps
            'contact_map_visible' => (bool) Setting::get('contact_map_visible', true),
            'contact_map_title' => Setting::get('contact_map_title', 'Regional Headquarters Location'),
            'contact_map_subtitle' => Setting::get('contact_map_subtitle', 'Visit our engineering facility in Al Khawaneej 2, Dubai, United Arab Emirates.'),
            'contact_map_iframe' => Setting::get('contact_map_iframe', '<iframe src="https://maps.google.com/maps?q=Structurflex%20Middle%20East%20Contracting%20LLC%20Dubai&t=&z=14&ie=UTF8&iwloc=&output=embed" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>'),
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                // BANNER
                Section::make('Contact Page Banner')
                    ->description('Header headline and subtitle on the /contact page.')
                    ->icon('heroicon-o-sparkles')
                    ->collapsible()
                    ->schema([
                        Grid::make(12)->schema([
                            TextInput::make('contact_banner_tag')
                                ->label('Tag / Badge')
                                ->required()
                                ->columnSpan(4),

                            TextInput::make('contact_banner_title')
                                ->label('Page Title (H1)')
                                ->required()
                                ->columnSpan(8),

                            Textarea::make('contact_banner_subtitle')
                                ->label('Subtitle Description')
                                ->rows(2)
                                ->required()
                                ->columnSpan(12),
                        ]),
                    ]),

                // DUBAI HEADQUARTERS
                Section::make('Dubai Regional Headquarters')
                    ->description('Primary operating address, telephone, inquiry emails, and working hours.')
                    ->icon('heroicon-o-building-office-2')
                    ->collapsible()
                    ->schema([
                        Grid::make(12)->schema([
                            TextInput::make('dubai_office_title')
                                ->label('Office Title')
                                ->required()
                                ->columnSpan(6),

                            TextInput::make('dubai_hours')
                                ->label('Operating Hours')
                                ->placeholder('Mon - Fri: 8:00 AM - 5:30 PM (GST)')
                                ->required()
                                ->columnSpan(6),

                            Textarea::make('dubai_address')
                                ->label('Full Street / Facility Address')
                                ->rows(3)
                                ->required()
                                ->columnSpan(8),

                            TextInput::make('dubai_po_box')
                                ->label('Post Office (P.O. Box)')
                                ->placeholder('P. O BOX: 98447')
                                ->columnSpan(4),

                            TextInput::make('dubai_phone')
                                ->label('Telephone')
                                ->placeholder('+971 4 238 8455')
                                ->required()
                                ->columnSpan(4),

                            TextInput::make('dubai_email')
                                ->label('Direct Tender Email')
                                ->placeholder('dubai@structurflex.ae')
                                ->required()
                                ->columnSpan(4),

                            TextInput::make('general_email')
                                ->label('General / Inquiries Email')
                                ->placeholder('info@structurflex.ae')
                                ->required()
                                ->columnSpan(4),
                        ]),
                    ]),

                // CAIRO REGIONAL BRANCH
                Section::make('Cairo Regional Branch')
                    ->description('Egypt & North Africa regional engineering branch details.')
                    ->icon('heroicon-o-building-office')
                    ->collapsible()
                    ->schema([
                        Grid::make(12)->schema([
                            TextInput::make('cairo_office_title')
                                ->label('Branch Title')
                                ->required()
                                ->columnSpan(6),

                            TextInput::make('cairo_phone')
                                ->label('Fax')
                                ->placeholder('+971 4 238 8499')
                                ->required()
                                ->columnSpan(6),

                            Textarea::make('cairo_address')
                                ->label('Branch Address')
                                ->rows(2)
                                ->required()
                                ->columnSpan(8),

                            TextInput::make('cairo_email')
                                ->label('Branch Email Desk')
                                ->placeholder('cairo@structurflex.ae')
                                ->required()
                                ->columnSpan(4),
                        ]),
                    ]),

                // WHATSAPP QUICK-CONNECT
                Section::make('WhatsApp Quick-Connect')
                    ->description('WhatsApp hotline number used across the homepage, contact page, and header/footer.')
                    ->icon('heroicon-o-chat-bubble-left-right')
                    ->collapsible()
                    ->schema([
                        Grid::make(12)->schema([
                            TextInput::make('whatsapp_number')
                                ->label('WhatsApp Phone Number (with Country Code, digits only)')
                                ->placeholder('971502959942')
                                ->helperText('E.g., 971502959942 (without + or spaces)')
                                ->required()
                                ->columnSpan(6),

                            TextInput::make('whatsapp_title')
                                ->label('WhatsApp Box Title')
                                ->required()
                                ->columnSpan(6),

                            Textarea::make('whatsapp_text')
                                ->label('WhatsApp Box Helper Text')
                                ->rows(2)
                                ->required()
                                ->columnSpan(12),
                        ]),
                    ]),

                // GOOGLE MAPS EMBED
                Section::make('Interactive Google Maps Location')
                    ->description('Embed an interactive Google Map for your headquarters or factory location.')
                    ->icon('heroicon-o-map-pin')
                    ->collapsible()
                    ->schema([
                        Grid::make(12)->schema([
                            Toggle::make('contact_map_visible')
                                ->label('Show Google Map Section')
                                ->helperText('Toggle to display or hide the map on the Contact page')
                                ->default(true)
                                ->columnSpan(12),

                            TextInput::make('contact_map_title')
                                ->label('Section Title')
                                ->required()
                                ->columnSpan(6),

                            TextInput::make('contact_map_subtitle')
                                ->label('Section Subtitle')
                                ->required()
                                ->columnSpan(6),

                            Textarea::make('contact_map_iframe')
                                ->label('Google Maps Embed Code (<iframe>) or Embed URL')
                                ->helperText('Paste the full <iframe>...</iframe> HTML from Google Maps ("Share" → "Embed a map") or a direct map embed URL.')
                                ->rows(4)
                                ->required()
                                ->columnSpan(12),
                        ]),
                    ]),
            ])
            ->statePath('data');
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label('Save Contact & Office Settings')
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
            ->title('Contact and office settings saved successfully')
            ->body('All changes are now live across the Contact page, Homepage, and Global Footer.')
            ->success()
            ->send();
    }
}
