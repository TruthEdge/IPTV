<?php

namespace App\Http\Livewire\Admin\Vouchers;

use App\Models\Voucher;
use Livewire\Component;

class VouchersEdit extends Component
{
    public $voucher ,$currencies;

    function mount($id)
    {

        $voucher = Voucher::findOrFail($id);
        $this->voucher = $voucher->toArray();


    }

    public function update()
    {
        $this->validate([
            'voucher.code' => 'required|numeric|digits:12|unique:vouchers,code,'. $this->voucher['id'],
            'voucher.price' => 'required|numeric',
        ]);


        $voucher = Voucher::findOrFail($this->voucher['id']);

        $voucher->update($this->voucher);
        $this->emit('success',__("Updated successfully"));

    }

    public function render()
    {
        return view('livewire.admin.vouchers.vouchers-edit');
    }
}
