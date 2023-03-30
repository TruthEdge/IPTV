<?php

namespace App\Http\Livewire\Admin\Accounts;

use App\Models\Account;
use App\Models\AccountUser;
use Livewire\Component;
use Livewire\WithPagination;

class Accounts extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['refreshModal'];

    public $search, $name, $email, $mobile, $deleteId, $account_id, $role_id, $role, $create_account;

    public function mount()
    {
        if (request('role_id')) {
            $this->role_id = request('role_id');
        }
    }


    public function search()
    {
        $this->resetPage();
    }

    public function deleteId($id)
    {
        $this->deleteId = $id;
    }

    public function EditAccount($id)
    {
        $this->account_id = $id;
    }

    public function CreateAccount()
    {
        $this->create_account = rand(0, 10000);
    }

    public function refreshModal()
    {
        $this->account_id = "";
        $this->create_account = "";
    }


    public function delete()
    {

        $accounts = Account::findOrFail($this->deleteId);

        if (!auth()->account()->can('accounts delete')) {
            $this->emit('error','accounts does not have the right permissions.');
            return false;
        }

        $this->emit('error','accounts does not have the right permissions.');
        return false;

        $accounts->delete();
        $this->emit('success',__("Deleted successfully"));

    }

    public function render()
    {
        $accounts = Account::query();

        $accounts = $accounts->whereIn('id', AccountUser::where('user_id',auth()->id())->pluck('account_id')->toArray());

        $accounts = $accounts->latest()->paginate(10);
        return view('livewire.admin.accounts.accounts', compact('accounts'))->layout('layouts.admins.app');
    }
}
