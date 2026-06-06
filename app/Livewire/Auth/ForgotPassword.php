<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Password;

class ForgotPassword extends Component
{
    public $email = '';
    public $status = '';

    public function sendResetLink()
    {
        $this->validate([
            'email' => 'required|email',
        ]);

        $response = Password::broker()->sendResetLink(
            ['email' => $this->email]
        );

        if ($response == Password::RESET_LINK_SENT) {
            $this->status = __($response);
            $this->email = '';
        } else {
            $this->addError('email', __($response));
        }
    }

    public function render()
    {
        return view('livewire.auth.forgot-password')->layout('layouts.guest');
    }
}
