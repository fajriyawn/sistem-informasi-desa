<?php

namespace App\Filament\Pages;

use Filament\Forms\Components\TextInput;
use Filament\Pages\Auth\Login as BaseLogin;

class Login extends BaseLogin
{
    /**
     * @return array<int, \Filament\Forms\Components\Component>
     */
    protected function getForms(): array
    {
        return [
            'form' => $this->form(
                $this->makeForm()
                    ->schema([
                        TextInput::make('login')
                            ->label('Email atau Username')
                            ->required()
                            ->autocomplete()
                            ->autofocus(),
                        $this->getPasswordFormComponent(),
                        $this->getRememberFormComponent(),
                    ])
                    ->statePath('data'),
            ),
        ];
    }

    /**
     * Mendapatkan credentials login dari data form login.
     */
    protected function getCredentialsFromFormData(array $data): array
    {
        $login_type = filter_var($data['login'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        return [
            $login_type => $data['login'],
            'password' => $data['password'],
        ];
    }
}

