<?php

namespace App\Http\Livewire\Admin\Accounts;

use App\Models\Account;
use App\Models\AccountUser;
use App\Models\Price;
use Livewire\Component;
use Livewire\WithFileUploads;

class AccountsEdit extends Component
{

    use WithFileUploads;


    public $account = [
        'bouquet' => [],
        'duration' => 1,
        'is_trial' => false
    ],$price;


    function mount($id)
    {
        $account = Account::findOrFail($id);
        $this->account = $account->toArray();
        $this->account['bouquet'] = json_decode($account->bouquet);
        $this->account['duration'] = 1;
    }

    public function update()
    {
        dd("You dont have permissions");
        $this->validate([
            'account.password' => 'required',
            'account.username' => 'required|unique:'.Account::class.',username,' . $this->account['id'],
            'account.is_trial' => 'boolean',
            'account.bouquet' => 'array',
        ]);

        $account = Account::findOrFail($this->account['id']);
        $account->password = $this->account['password'];
        $account->username = $this->account['username'];
        $account->is_trial = $this->account['is_trial'];
        $account->bouquet = json_encode($this->account['bouquet']);
        $account->save();

        $this->emit('success', __("Updated successfully"));

    }


    public function render()
    {
        if($this->account['is_trial']){
            $this->price = 0;
        }else {
            $price = Price::whereIn('bouquet_id', $this->account['bouquet'])->sum('value');
            $this->price = $price * $this->account['duration'] - $price * $this->account['duration'] * 0.15;
        }

        return view('livewire.admin.accounts.accounts-edit')->layout('layouts.admins.app');
    }
}
