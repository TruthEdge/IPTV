<?php

namespace App\Http\Livewire\Admin\Transactions;

use App\Models\Bouquet;
use App\Models\Transaction;
use Livewire\Component;
use Livewire\WithPagination;

class Transactions extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['refreshModal'];


    public $search, $bouquets, $bouquet_id, $deleteId, $transaction_id, $create_transaction, $Status;

    public function search()
    {

    }

    function mount()
    {
        $this->bouquets = Bouquet::get();

    }

    public function render()
    {
        $transactions = Transaction::query();

        if (!auth()->user()->hasRole('Admin')) {
            $transactions = $transactions->where('user_id', auth()->id());
        }

        $transactions = $transactions->latest()->paginate(10);
        return view('livewire.admin.transactions.transactions', compact('transactions'))->layout('layouts.admins.app');
    }

}
