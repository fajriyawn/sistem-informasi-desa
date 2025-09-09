<?php

namespace App\Filament\Pages;

use Filament\Forms\Components\TextInput;
use Filament\Http\Responses\Auth\Contracts\LoginResponse;
use Filament\Pages\Auth\Login as BaseLogin;
use MarcoGermani87\FilamentCaptcha\Forms\Components\CaptchaField; // Gunakan CaptchaField dari package yang benar

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
                        TextInput::make('email')
                            ->label(__('filament-panels::pages/auth/login.form.email.label'))
                            ->email()
                            ->required()
                            ->autocomplete()
                            ->autofocus(),
                        TextInput::make('password')
                            ->label(__('filament-panels::pages/auth/login.form.password.label'))
                            ->password()
                            ->required(),
                        $this->getRememberFormComponent(),
                        // Tambahkan CaptchaField dari package yang benar
                        // ...existing code...
                    ])
                    ->statePath('data'),
            ),
        ];
    }

    public function authenticate(): ?LoginResponse
    {
        // Panggil validasi form
        $this->form->validate();

        // Validasi tambahan (jika diperlukan) bisa diletakkan di sini,
        // namun package ini seharusnya sudah menambahkan validasi 'captcha' secara otomatis.

        // Jika validasi berhasil, panggil metode autentikasi asli dari Filament
        return parent::authenticate();
    }
}