<?php

namespace App\Http\Livewire\Admin\Vouchers;

use App\Models\Voucher;
use Livewire\Component;

class VouchersCreate extends Component
{
    public $voucher;


    function mount()
    {
        $this->voucher['code'] = rand(111111111111, 999999999999);
    }

    public function store()
    {
        $this->validate([
            'voucher.code' => 'required|numeric|digits:12|unique:vouchers,code',
            'voucher.price' => 'required|numeric',
        ]);


        $voucher = Voucher::create($this->voucher);

        $this->emit('success', __("Added successfully"));
        $this->voucher = [];
    }


    public function render()
    {
        return view('livewire.admin.vouchers.vouchers-create');
    }

}
