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

class ManageCapabilities extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-cpu-chip';

    protected static ?string $navigationGroup = 'Site Settings & Branding';

    protected static ?string $navigationLabel = 'Our Capabilities';

    protected static ?string $title = 'Our Capabilities & Turnkey Workflow Management';

    protected static ?int $navigationSort = 2;

    protected static string $view = 'filament.pages.manage-capabilities';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill([
            'workflow_section_visible' => (bool) Setting::get('workflow_section_visible', true),
            'workflow_section_tag' => Setting::get('workflow_section_tag', 'Turnkey Workflow'),
            'workflow_section_title' => Setting::get('workflow_section_title', 'OUR CAPABILITIES'),
            'workflow_section_subtitle' => Setting::get('workflow_section_subtitle', 'From initial mathematical form-finding to lifetime structural stewardship, Structurflex Middle East manages the entire project lifecycle in-house.'),
            'workflow_steps' => $this->getInitialWorkflowSteps(),
        ]);
    }

    protected function getInitialWorkflowSteps(): array
    {
        $saved = Setting::get('workflow_steps');
        if ($saved) {
            $decoded = json_decode($saved, true);
            if (is_array($decoded) && count($decoded) > 0) {
                return $decoded;
            }
        }

        return [
            [
                'step_num' => 'Step 01',
                'title' => 'Design',
                'icon' => 'design',
                'description' => 'Parametric form-finding, 3D architectural geometry, conceptual equilibrium modeling & digital prototyping.',
                'is_visible' => true,
            ],
            [
                'step_num' => 'Step 02',
                'title' => 'Engineering',
                'icon' => 'engineering',
                'description' => 'Advanced membrane analysis, non-linear FEA, computational wind load modeling, and structural cable sizing.',
                'is_visible' => true,
            ],
            [
                'step_num' => 'Step 03',
                'title' => 'Fabrication',
                'icon' => 'fabrication',
                'description' => 'State-of-the-art cleanroom manufacturing, automated CNC precision cutting, and high-frequency molecular seaming.',
                'is_visible' => true,
            ],
            [
                'step_num' => 'Step 04',
                'title' => 'Installation',
                'icon' => 'installation',
                'description' => 'Expert site execution, certified master rigging, crane erection, laser-measured pre-stressing, and stringent HSE.',
                'is_visible' => true,
            ],
            [
                'step_num' => 'Step 05',
                'title' => 'Inspection & AMC',
                'icon' => 'maintenance',
                'description' => 'Regular membrane condition audits, non-destructive cleaning, cable re-tensioning, and lifetime preventive maintenance.',
                'is_visible' => true,
            ],
        ];
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Turnkey Workflow Section (Our Capabilities)')
                    ->description('Configure the sequential turnkey engineering delivery pipeline displayed on the homepage.')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                TextInput::make('workflow_section_tag')
                                    ->label('Section Badge / Tag')
                                    ->placeholder('Turnkey Workflow')
                                    ->required()
                                    ->columnSpan(2),

                                Toggle::make('workflow_section_visible')
                                    ->label('Show Section')
                                    ->default(true),
                            ]),

                        TextInput::make('workflow_section_title')
                            ->label('Section Main Title (H2)')
                            ->placeholder('OUR CAPABILITIES')
                            ->required(),

                        Textarea::make('workflow_section_subtitle')
                            ->label('Section Description')
                            ->rows(2)
                            ->placeholder('From initial mathematical form-finding to lifetime structural stewardship...')
                            ->required(),

                        Repeater::make('workflow_steps')
                            ->label('Workflow Step Cards')
                            ->helperText('Manage each sequential step in the turnkey delivery workflow (reorder, customize, or toggle visibility).')
                            ->schema([
                                Grid::make(12)
                                    ->schema([
                                        TextInput::make('step_num')
                                            ->label('Step Number')
                                            ->placeholder('Step 01')
                                            ->required()
                                            ->columnSpan(3),

                                        TextInput::make('title')
                                            ->label('Step Title')
                                            ->placeholder('Design')
                                            ->required()
                                            ->columnSpan(4),

                                        Select::make('icon')
                                            ->label('Icon Style')
                                            ->options([
                                                'design' => 'Design (Pencil / Compass)',
                                                'engineering' => 'Engineering (FEA Calipers / Axes)',
                                                'fabrication' => 'Fabrication (Cleanroom / Machinery)',
                                                'installation' => 'Installation (Laser Survey / Rigging)',
                                                'maintenance' => 'Inspection & AMC (Shield / Quality)',
                                            ])
                                            ->default('design')
                                            ->required()
                                            ->columnSpan(3),

                                        Toggle::make('is_visible')
                                            ->label('Visible')
                                            ->default(true)
                                            ->columnSpan(2),

                                        Textarea::make('description')
                                            ->label('Step Description')
                                            ->rows(2)
                                            ->placeholder('Parametric form-finding, 3D architectural geometry...')
                                            ->required()
                                            ->columnSpan(12),
                                    ]),
                            ])
                            ->collapsible()
                            ->itemLabel(fn (array $state): ?string => ($state['step_num'] ?? '') . ' - ' . ($state['title'] ?? 'Workflow Step'))
                            ->addActionLabel('Add Workflow Step')
                            ->reorderableWithButtons(),
                    ]),
            ])
            ->statePath('data');
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label('Save Capabilities Settings')
                ->submit('save')
                ->icon('heroicon-o-check-circle')
                ->color('primary'),
        ];
    }

    public function save(): void
    {
        $state = $this->form->getState();

        Setting::set('workflow_section_visible', $state['workflow_section_visible'] ?? true);
        Setting::set('workflow_section_tag', $state['workflow_section_tag'] ?? '');
        Setting::set('workflow_section_title', $state['workflow_section_title'] ?? '');
        Setting::set('workflow_section_subtitle', $state['workflow_section_subtitle'] ?? '');
        Setting::set('workflow_steps', json_encode(array_values($state['workflow_steps'] ?? [])));

        Notification::make()
            ->title('Capabilities & Workflow settings saved successfully')
            ->body('The turnkey workflow section on the homepage has been updated with your latest changes.')
            ->success()
            ->send();
    }
}
