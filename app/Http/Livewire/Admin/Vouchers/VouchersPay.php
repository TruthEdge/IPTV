<?php

namespace App\Http\Livewire\Admin\Vouchers;

use App\Models\User;
use App\Models\Voucher;
use Illuminate\Support\Str;
use Livewire\Component;

class VouchersPay extends Component
{
    public $voucher;

    function mount()
    {

    }

    public function pay()
    {
        $this->validate([
            'voucher.code' => 'required|numeric|digits:12',
        ]);

        $voucher = Voucher::where('code', $this->voucher['code'])->first();

        if (!$voucher) {
            $this->addError('voucher.code', 'Sorry, the code is not available');
            return false;
        } elseif ($voucher->user_id != null) {
            $this->addError('voucher.code', 'Sorry, the code is already in use');
            return false;
        } elseif ($voucher and $voucher->user_id == null) {


            //User
            $auth = auth()->id();
            $user = User::findOrFail($auth);
            $user->update();
            $current_balance = $user->balance + $voucher->price;
            $user->balance = $current_balance;
            $user->save();

            $voucher->user_id = auth()->id();
            $voucher->save();

            $this->emit('success', __("Your new balance is: " . $user->balance . ' '. $user->balance ));
            $this->voucher = [];

        } else {
            $this->emit('alertError', __("Sorry, there was an error, try again"));
            $this->voucher = [];
        }

    }


    public function render()
    {
        return view('livewire.admin.vouchers.vouchers-pay')->layout('layouts.admins.app');
    }

}
