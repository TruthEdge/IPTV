<?php

namespace App\Http\Livewire\Admin\Prices;

use App\Models\Application;
use App\Models\Bouquet;
use App\Models\Price;
use App\Models\Country;
use Livewire\Component;

class PricesCreate extends Component
{
    public $price, $bouquets;


    public function mount()
    {

        $this->bouquets = Bouquet::get();
    }

    public function store()
    {
        $this->validate([
            'price.bouquet_id' => 'required',
            'price.value' => 'required|numeric',
        ]);

        $price = Price::updateOrCreate([
            'bouquet_id' => $this->price['bouquet_id'],
        ],[
            'value' => $this->price['value'],
        ]);

        $this->emit('success', __("Added successfully"));
        $this->price = [];

    }


    public function render()
    {
        return view('livewire.admin.prices.prices-create')->layout('layouts.admins.app');
    }

}
