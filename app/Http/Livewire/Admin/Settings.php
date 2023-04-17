<?php

namespace App\Http\Livewire\Admin;

use App\Cache\GeneralCache;
use App\Models\Setting;
use Livewire\Component;
use Livewire\WithFileUploads;

class Settings extends Component
{
    use WithFileUploads;
    public $logo,$logoTemp,$site_name,$description,$address,$email,$mobile,$phone,$url_linkedin ,$url_map,$url_twitter ,$url_facebook ,$url_instagram ,$url_whatsapp ,$active;
    protected $cacheObj;
    public function mount(){
        $this->cacheObj=new GeneralCache();
        if(!$settings=$this->cacheObj->getAllSettingsCache()){
            $settings=Setting::all();
            $this->cacheObj->setDataInCache($this->cacheObj->getSettingsCache(),$settings);
        }
        $this->logo = $settings->firstWhere('name',"logo")?->value ?: '';
        $this->site_name = $settings->firstWhere('name',"site_name")?->value ?: '';
        $this->description = $settings->firstWhere('name',"description")?->value ?: '';
        $this->address = $settings->firstWhere('name',"address")?->value ?: '';
        $this->email = $settings->firstWhere('name',"email")?->value ?: '';
        $this->mobile =$settings->firstWhere('name',"mobile")?->value ?: '';
        $this->phone = $settings->firstWhere('name',"phone")?->value ?: '';
        $this->url_twitter =$settings->firstWhere('name',"url_twitter")?->value ?: '';
        $this->url_facebook = $settings->firstWhere('name',"url_facebook")?->value ?: '';
        $this->url_instagram = $settings->firstWhere('name',"url_instagram")?->value ?: '';
        $this->url_whatsapp = $settings->firstWhere('name',"url_whatsapp")?->value ?: '';
        $this->url_linkedin = $settings->firstWhere('name',"url_linkedin")?->value ?: '';
        $this->url_map = $settings->firstWhere('name',"url_map")?->value ?: '';
        $this->active = $settings->firstWhere('name',"active")?->value ?: '';
    }


    public function update()
    {
       $array =  $this->validate([
            'site_name' => 'required',
            'description' => '',
            'address' => '',
            'email' => '',
            'mobile' => '',
            'phone' => '',
            'url_twitter' => '',
            'url_facebook' => '',
            'url_instagram' => '',
            'url_whatsapp' => '',
            'url_linkedin' => '',
            'url_map' => '',
            'active' => '',
          ]);

        foreach ($array as $key => $value) {
            if($key != "logo") {
                Setting::updateOrCreate(
                    ['name' => $key],
                    ['value' => $value]
                );
            }
        }


        if($this->logoTemp){

            $array =  $this->validate([
//                'logoTemp' => ['image','mimes:jpeg,png,jpg,gif','max:2048','dimensions:max_width=83,max_height=29']
                'logoTemp' => ['image','mimes:jpeg,png,jpg,gif,svg','max:2048']
            ]);

            Setting::updateOrCreate(
                ['name' => 'logo'],
                ['value' => $this->logoTemp?$this->logoTemp->store('logos'):""]

            );
        }

        $this->emit('success',__("Updated successfully"));
        return redirect()->route('admin.settings');

    }


    public function render()
    {
        return view('livewire.admin.settings')->layout('layouts.admins.app');
    }
}
