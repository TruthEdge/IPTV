<?php

namespace App\Http\Livewire\Admin\Prices;

use App\Models\Bouquet;
use App\Models\Price;
use Livewire\Component;
use Livewire\WithPagination;

class Prices extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['refreshModal'];


    public $search, $bouquet_id, $deleteId, $price_id, $create_price, $Status;

    public function search()
    {

    }

    function mount()
    {
        $this->bouquets = Bouquet::get();
    }


    public function deleteId($id)
    {
        $this->deleteId = $id;
    }

    public function EditPrice($id)
    {
        $this->price_id = $id;
    }

    public function CreatePrice()
    {
        $this->create_price = rand(0, 10000);
    }

    public function Status($id)
    {
        $this->Status = $id;
    }

    public function refreshModal()
    {
        $this->price_id = "";
        $this->create_price = "";
    }

    public function delete()
    {

        $prices = Price::findOrFail($this->deleteId);

        if (!auth()->user()->can('applications countries delete')) {
            $this->emit('error', 'Application does not have the right permissions.');
            return false;
        }

        $prices->delete();
        $this->emit('success', __("Deleted successfully"));

    }

    public function render()
    {
        $prices = Price::query();

        if ($this->bouquet_id) {
            $prices = $prices->where('bouquet_id', $this->bouquet_id);
        }

        $prices = $prices->orderBy('created_at', "DESC")->paginate(10);
        return view('livewire.admin.prices.prices', compact('prices'))->layout('layouts.admins.app');
    }

}
