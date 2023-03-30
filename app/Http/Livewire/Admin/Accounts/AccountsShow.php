<?php

namespace App\Http\Livewire\Admin\Accounts;

use App\Models\Account;
use Livewire\Component;

class AccountsShow extends Component
{
    public $account ;

    function mount($id)
    {
        $this->account = Account::findOrFail($id);
    }

    public function render()
    {
        return view('livewire.admin.accounts.accounts-show')->layout('layouts.admins.app');
    }

}
