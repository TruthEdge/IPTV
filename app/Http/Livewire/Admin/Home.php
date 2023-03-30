<?php

namespace App\Http\Livewire\Admin;

use App\Models\Client;
use App\Models\Contact;


use App\Models\Partner;
use App\Models\Service;
use App\Models\Slider;
use App\Models\SubscribeNews;
use App\Models\Team;
use App\Models\User;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class Home extends Component
{

    public $models;

    public function mount(){

        if(auth()->check() and auth()->user()->hasRole('Admin')) {
            $this->models = [
                'Roles' => Role::count(),
                'Users' => User::count(),
            ];
        } else {
            $this->models = [];
        }

    }

    public function render()
    {
        return view('livewire.admin.home')->layout('layouts.admins.app');
    }
}
