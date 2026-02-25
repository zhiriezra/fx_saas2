<?php

namespace App\Filament\Pages\Auth;

use App\Models\User;
use App\Models\Team;
use App\Models\TeamType;
use Filament\Facades\Filament;
use Filament\Forms\Components\Component;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Form;
use Filament\Http\Responses\Auth\RegistrationResponse;
use Filament\Notifications\Notification;
use Filament\Pages\Auth\Register as BaseRegister;
use Illuminate\Auth\Events\Registered;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class Register extends BaseRegister
{
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                $this->getFirstNameFormComponent(),
                $this->getLastNameFormComponent(),
                $this->getMiddleNameFormComponent(),
                $this->getEmailFormComponent(),
                $this->getPhoneFormComponent(),
                $this->getPasswordFormComponent(),
                $this->getPasswordConfirmationFormComponent(),
                $this->getCompanyNameFormComponent(),
                $this->getCompanyCategoryFormComponent(),
                $this->getCompanyLogoFormComponent(),
                $this->getTermsFormComponent(),
            ])
            ->statePath('data');
    }

    protected function getFirstNameFormComponent(): Component
    {
        return TextInput::make('firstname')
            ->label('First Name')
            ->required()
            ->maxLength(255)
            ->autofocus();
    }

    protected function getLastNameFormComponent(): Component
    {
        return TextInput::make('lastname')
            ->label('Last Name')
            ->required()
            ->maxLength(255);
    }

    protected function getMiddleNameFormComponent(): Component
    {
        return TextInput::make('middlename')
            ->label('Middle Name')
            ->maxLength(255)
            ->nullable();
    }

    protected function getEmailFormComponent(): Component
    {
        return TextInput::make('email')
            ->label(__('filament-panels::pages/auth/register.form.email.label'))
            ->email()
            ->required()
            ->maxLength(255)
            ->unique(User::class);
    }

    protected function getPhoneFormComponent(): Component
    {
        return TextInput::make('phone')
            ->label('Phone Number')
            ->tel()
            ->required()
            ->maxLength(255)
            ->placeholder('+234...')
            ->rule('regex:/^\+?[1-9]\d{1,14}$/');
    }

    protected function getPasswordFormComponent(): Component
    {
        return TextInput::make('password')
            ->label(__('filament-panels::pages/auth/register.form.password.label'))
            ->password()
            ->required()
            ->rule(Password::default())
            ->dehydrateStateUsing(fn ($state) => Hash::make($state))
            ->same('passwordConfirmation')
            ->validationAttribute(__('filament-panels::pages/auth/register.form.password.validation_attribute'));
    }

    protected function getPasswordConfirmationFormComponent(): Component
    {
        return TextInput::make('passwordConfirmation')
            ->label(__('filament-panels::pages/auth/register.form.password_confirmation.label'))
            ->password()
            ->required()
            ->maxLength(255)
            ->dehydrated(false);
    }

    protected function getCompanyNameFormComponent(): Component
    {
        return TextInput::make('company_name')
            ->label('Company Name')
            ->required()
            ->maxLength(255);
    }

    protected function getCompanyCategoryFormComponent(): Component
    {
        return Select::make('company_category')
            ->label('Company Category')
            ->options(TeamType::all()->pluck('name', 'id'))
            ->required()
            ->searchable()
            ->placeholder('Select company category');
    }

    protected function getCompanyLogoFormComponent(): Component
    {
        return FileUpload::make('company_logo')
            ->label('Company Logo (optional)')
            ->image()
            ->maxSize(2048)
            ->directory('company-logos')
            ->nullable();
    }

    protected function getTermsFormComponent(): Component
    {
        return Checkbox::make('terms')
            ->label('I agree to the Terms and Privacy Policy')
            ->required()
            ->accepted();
    }

    public function register(): ?RegistrationResponse
    {
        try {
            $this->rateLimit(2);
        } catch (\Throwable $exception) {
            Notification::make()
                ->title(__('filament-panels::pages/auth/register.notifications.throttled.title', [
                    'seconds' => $exception->secondsUntilAvailable,
                    'minutes' => ceil($exception->secondsUntilAvailable / 60),
                ]))
                ->body(array_key_exists('body', __('filament-panels::pages/auth/register.notifications.throttled') ?: []) ? __('filament-panels::pages/auth/register.notifications.throttled.body', [
                    'seconds' => $exception->secondsUntilAvailable,
                    'minutes' => ceil($exception->secondsUntilAvailable / 60),
                ]) : null)
                ->danger()
                ->send();

            return null;
        }

        $data = $this->form->getState();

        $user = $this->createUser($data);

        event(new Registered($user));

        Filament::auth()->login($user);

        session()->regenerate();

        return app(RegistrationResponse::class);
    }

    protected function createUser(array $data): User
    {
        // Create the team/company first
        $team = Team::create([
            'name' => $data['company_name'],
            'team_type_id' => $data['company_category'],
            'logo' => $data['company_logo'] ?? null,
        ]);

        // Create the user
        $user = User::create([
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'middlename' => $data['middlename'] ?? null,
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => $data['password'],
            'user_type_id' => 1, // Company admin user type
        ]);

        // Attach user to team
        $user->teams()->attach($team);

        return $user;
    }
}