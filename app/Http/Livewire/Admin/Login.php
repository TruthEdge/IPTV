<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Login extends Component
{
    public $email, $password, $remember;


    public function mount()
    {


        if (request()->route()->getName() == "admin.logout") {
            auth()->logout();
            redirect()->route('admin.home');
        }

        if (auth()->check()) {
            redirect()->route('admin.home');
        }


    }


    public function login()
    {

        $validate = $this->validate([
            'email' => 'required|email|exists:'.User::class.',email',
            'password' => 'required',
        ]);


        $user = User::where('email', $this->email)->first();

        if (Hash::check($this->password, $user->password)) {

            if ($user->status != 1 ) {

                $this->addError('email', 'Account status disabled');
            }

            else {
                auth()->login($user);
                return redirect()->route('admin.home');
            }

        } else {
            $this->addError('email', 'Invalid Login');
        }

    }

    public function render()
    {
        return view('livewire.admin.login')->layout('layouts.admins.app');
    }
}
