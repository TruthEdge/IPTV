<?php

namespace App\Http\Livewire\Admin\Vouchers;

use App\Models\Voucher;
use Livewire\Component;
use Livewire\WithPagination;

class Vouchers extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['refreshModal'];

    public $search, $deleteId, $code,$pay_voucher, $voucher_id,$create_voucher;


    public function search()
    {

    }

    public function PayVoucher()
    {
        $this->pay_voucher = rand(0, 10000);
    }

    public function deleteId($id)
    {
        $this->deleteId = $id;
    }

    public function CreateVoucher()
    {
        $this->create_voucher = rand(0, 10000);
    }

    public function EditVoucher($id)
    {
        $this->voucher_id = $id;
    }

    public function refreshModal()
    {
        $this->voucher_id = "";
        $this->create_voucher = "";
    }


    public function delete()
    {

        $vouchers = Voucher::findOrFail($this->deleteId);

        if (!auth()->guard('web')->user()->can('vouchers delete')) {
            $this->emit('error', 'Voucher does not have the right permissions.');
            return false;
        }

        $vouchers->delete();
        $this->emit('success',__("Deleted successfully"));
    }


    public function render()
    {
        $vouchers = Voucher::query();

        if ($this->code) {
            $vouchers = $vouchers->where("code", 'LIKE', "%" . $this->code . "%");
        }

        $vouchers = $vouchers->orderBy('created_at', "DESC")->paginate(10);

        return view('livewire.admin.vouchers.vouchers', compact('vouchers'))->layout('layouts.admins.app');
    }

}
