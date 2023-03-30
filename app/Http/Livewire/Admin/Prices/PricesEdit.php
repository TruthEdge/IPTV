<?php

namespace App\Http\Livewire\Admin\Prices;

use App\Models\Application;
use App\Models\Bouquet;
use App\Models\Price;
use App\Models\Country;
use Livewire\Component;

class PricesEdit extends Component
{
    public $price, $bouquets;

    function mount($id)
    {
        $price = Price::findOrFail($id);
        $this->price = $price->toArray();
        $this->bouquets = Bouquet::get();
    }

    public function update()
    {
        $this->validate([
            'price.bouquet_id' => 'required',
            'price.value' => 'required|numeric',
        ]);

        $price = Price::findOrFail($this->price['id']);
        $price->update($this->price);
        $this->emit('success', __("Updated successfully"));
    }


    public function render()
    {
        return view('livewire.admin.prices.prices-edit')->layout('layouts.admins.app');
    }

}
