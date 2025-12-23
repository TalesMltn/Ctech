<?php

namespace App\Filament\Pages;

use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Storage;
use Livewire\Features\SupportRedirects\Redirector;
use Illuminate\Http\RedirectResponse;
use Filament\Facades\Filament;

class ManagePaymentQRs extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-qr-code';
    protected static ?string $navigationLabel = 'Pagos QR';
    protected static ?string $navigationGroup = 'Configuración';
    protected static ?int $navigationSort = 99;
    protected static string $view = 'filament.pages.manage-payment-qrs';
    protected static ?string $title = 'Editar QR del Dueño';

    public ?array $data = [];
    public string $master_password = '';
    public bool $authorized = false;
    public bool $showPassword = false;

    public function mount(): void
    {
        // Si ya tiene acceso autorizado en sesión, entra directo
        if (session('qr_access_authorized') === true) {
            $this->authorized = true;
            $this->loadConfig();
        }
    }

    protected function loadConfig(): void
    {
        $path = storage_path('app/pagos/config.json');
        if (file_exists($path)) {
            $config = json_decode(file_get_contents($path), true);
            $this->form->fill($config);
        }
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make(2)
                    ->schema([
                        Forms\Components\Section::make('Yape')
                            ->heading('Yape')
                            ->icon('heroicon-o-banknotes')
                            ->collapsible()
                            ->schema([
                                Forms\Components\FileUpload::make('qr_yape')
                                    ->label('QR de Yape')
                                    ->image()
                                    ->directory('pagos/qr')
                                    ->preserveFilenames()
                                    ->imagePreviewHeight('300')
                                    ->loadingIndicatorPosition('left')
                                    ->panelLayout('integrated')
                                    ->removeUploadedFileButtonPosition('right'),

                                Forms\Components\Grid::make(2)
                                    ->schema([
                                        Forms\Components\TextInput::make('phone_yape')
                                            ->label('Número de Yape')
                                            ->tel()
                                            ->maxLength(9)
                                            ->placeholder('927573591'),

                                        Forms\Components\TextInput::make('owner_yape')
                                            ->label('Titular')
                                            ->maxLength(100)
                                            ->placeholder('Tech Merch SAC'),
                                    ]),
                            ]),

                        Forms\Components\Section::make('Plin')
                            ->heading('Plin')
                            ->icon('heroicon-o-banknotes')
                            ->collapsible()
                            ->schema([
                                Forms\Components\FileUpload::make('qr_plin')
                                    ->label('QR de Plin')
                                    ->image()
                                    ->directory('pagos/qr')
                                    ->preserveFilenames()
                                    ->imagePreviewHeight('300')
                                    ->loadingIndicatorPosition('left')
                                    ->panelLayout('integrated')
                                    ->removeUploadedFileButtonPosition('right'),

                                Forms\Components\Grid::make(2)
                                    ->schema([
                                        Forms\Components\TextInput::make('phone_plin')
                                            ->label('Número de Plin')
                                            ->tel()
                                            ->maxLength(9)
                                            ->placeholder('927573591'),

                                        Forms\Components\TextInput::make('owner_plin')
                                            ->label('Titular')
                                            ->maxLength(100)
                                            ->placeholder('Tech Merch SAC'),
                                    ]),
                            ]),
                    ]),
            ])
            ->statePath('data');
    }

    public function authorizeAccess(): void
    {
        if ($this->master_password === 'BLACKOPS') {
            $this->authorized = true;
            session(['qr_access_authorized' => true]);
            $this->loadConfig();

            Notification::make()
                ->title('¡Acceso autorizado correctamente!')
                ->success()
                ->send();
        } else {
            Notification::make()
                ->title('Contraseña incorrecta')
                ->danger()
                ->send();
            $this->master_password = '';
        }
    }

    public function save(): void
    {
        $data = $this->form->getState();

        $path = storage_path('app/public/pagos/qr');
        if (!is_dir($path)) {
            mkdir($path, 0755, true);
        }

        // Siempre sobrescribir YAPE si hay imagen
        if (isset($data['qr_yape']) && $data['qr_yape']) {
            Storage::disk('public')->put('pagos/qr/qr-yape.png', Storage::disk('public')->get($data['qr_yape']));
        }
        $data['qr_yape'] = 'qr-yape.png';

        // Siempre sobrescribir PLIN si hay imagen
        if (isset($data['qr_plin']) && $data['qr_plin']) {
            Storage::disk('public')->put('pagos/qr/qr-plin.png', Storage::disk('public')->get($data['qr_plin']));
        }
        $data['qr_plin'] = 'qr-plin.png';

        // Guardar config.json
        $cleanData = [
            'qr_yape'     => $data['qr_yape'] ?? null,
            'phone_yape'  => $data['phone_yape'] ?? '',
            'owner_yape'  => $data['owner_yape'] ?? '',
            'qr_plin'     => $data['qr_plin'] ?? null,
            'phone_plin'  => $data['phone_plin'] ?? '',
            'owner_plin'  => $data['owner_plin'] ?? '',
        ];

        file_put_contents(storage_path('app/pagos/config.json'), json_encode($cleanData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

        Notification::make()
            ->title('¡QRs actualizados con éxito! Los cambios se ven al instante en el checkout.')
            ->success()
            ->send();
    }

    // ← MÉTODO QUE FALTABA: Cancelar
    public function cancel()
    {
        return redirect()->to('/admin');
    }
    
    public function logout()
    {
        session()->forget('qr_access_authorized');
        $this->authorized = false;
    
        Notification::make()
            ->title('Sesión cerrada correctamente')
            ->info()
            ->send();
    
        return redirect()->to('/admin');
    }

}