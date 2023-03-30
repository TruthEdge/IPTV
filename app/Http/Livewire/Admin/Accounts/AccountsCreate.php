<?php

namespace App\Http\Livewire\Admin\Accounts;

use App\Models\Account;
use App\Models\AccountUser;
use App\Models\Price;
use App\Models\Transaction;
use Livewire\Component;
use Livewire\WithFileUploads;

class AccountsCreate extends Component
{

    use WithFileUploads;

    public $account = [
        'bouquet' => [],
        'duration' => 1,
        'is_trial' => false
    ],$price;

    function mount($id)
    {

    }

    public function store()
    {

        $this->validate([
            'account.password' => 'required',
            'account.username' => 'required|unique:' . Account::class . ',username',
            'account.is_trial' => 'boolean',
            'account.bouquet' => 'required|array',
        ]);

        $user = auth()->user();

        if($this->price < 50){
            $this->addError('account.bouquet','The total bouquets should not be less than 50');
            return false;
        }

//        if($user->credits < $this->price){
//            $this->addError('account.bouquet','You do not have enough credits, your credits is: '.$user->credits);
//            return false;
//        }

        $account = new Account();
        $account->member_id = "1";
        $account->username = $this->account['username'];
        $account->password = $this->account['password'];
        $account->exp_date = $this->account['is_trial'] ? time()+24*60*60 : time()+$this->account['duration']*24*60*60;
        $account->admin_enabled = "1";
        $account->enabled = "1";
        $account->admin_notes = "";
        $account->reseller_notes = "";
        $account->email = null;
        $account->bouquet = json_encode($this->account['bouquet']);
        $account->bouquet_all = '["1"]';
        $account->max_connections = "1";
        $account->is_restreamer = "0";
        $account->allowed_ips = "[]";
        $account->allowed_ua = "[]";
        $account->is_trial = $this->account['is_trial']?1:0;
        $account->created_at = time();
        $account->created_by = "1";
        $account->pair_id = null;
        $account->is_mag = "0";
        $account->is_e2 = "0";
        $account->force_server_id = "0";
        $account->is_isplock = "0";
        $account->as_number = null;
        $account->isp_desc = "";
        $account->asn_lock = "0";
        $account->asn = "";
        $account->forced_country = "";
        $account->is_stalker = "0";
        $account->bypass_ua = "0";
        $account->play_token = "";
        $account->country_lock_date = null;
        $account->isp_lock_date = null;
        $account->suspect = "0";
        $account->autolock_ua = "0";
        $account->bypass_isp = "1";
        $account->package_id = null;
        $account->force_dns = null;
        $account->output = '["m3u8","ts","rtmp"]';
        $account->https = "0";
        $account->extend_at = null;
        $account->c_id = null;
        $account->save();

        AccountUser::create(['user_id' => auth()->id(),'account_id' => $account->id ]);

        $last_credits = $user->credits;
        $user->credits = $user->credits-$this->price;
        $user->save();


        Transaction::create([
            'user_id' => auth()->id(),
            'account_id' => $account->id,
            'credits' => $this->price,
            'last_credits' => $last_credits,
            'new_credits' => $user->credits,
            'bouquets' => json_encode($this->account['bouquet']),

        ]);

        $this->emit('success', __("Created successfully"));

    }


    public function render()
    {
        if($this->account['is_trial']){
            $this->price = 0;
        }else {
            $price = Price::whereIn('bouquet_id', $this->account['bouquet'])->sum('value');
            $this->price = $price * $this->account['duration'] - $price * $this->account['duration'] * 0.15;
        }
        return view('livewire.admin.accounts.accounts-create')->layout('layouts.admins.app');
    }
}
