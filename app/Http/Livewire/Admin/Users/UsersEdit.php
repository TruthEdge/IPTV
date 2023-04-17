<?php

namespace App\Http\Livewire\Admin\Users;

use App\Cache\Model\UserCache;
use App\Models\Department;
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use Spatie\Permission\Models\Role;

class UsersEdit extends Component
{

    use WithFileUploads;


    public  $user,$departments, $roles = [], $image ,$imageTemp,$CacheObj;

    function mount($id)
    {
        $this->CacheObj=new UserCache();
        $user=$this->CacheObj->getDetails($id) ?: User::findOrFail($id);
        $this->user = $user->toArray();
        $this->user['role_id'] = ($user->roles->count() > 0) ? $user->roles->first()->id : 0;

        $this->roles = Role::get();


    }

    public function update()
    {

        $this->validate([

            'user.name' => 'required|string',
            'user.email' => 'email|unique:users,email,' . $this->user['id'],
            'user.gender' => '',
            'user.description' => '',
            'user.birth_date' => '',
            'user.mobile' => 'required',
            'user.status' => '',
            'user.role_id' => 'required|exists:roles,id',

        ]);

        $this->user['user_id'] =  auth()->id();

        $user = User::findOrFail($this->user['id']);

        if($this->user['image']){
            $this->validate([
                'image' => ''
            ]);
        }

        if ($this->imageTemp) {
            $this->validate([ 'imageTemp' => 'image|mimes:jpeg,png,jpg,gif|max:2048' ]);
            $this->user['image'] = $this->imageTemp->store('users/'.$this->id);
        }else{
            unset($this->user['image']);
        }

        if (!empty($this->user['password']) and $this->user['password'] != "") {
            $this->validate([
                'user.password' => 'required|min:6',
            ]);
            $user->password = bcrypt($this->user['password']);
            $user->save();
            unset($this->user['password']);
        } else{
            unset($this->user['password']);
        }

        $user->syncRoles($this->user['role_id']);

        $user->update($this->user);
        $this->emit('success',__("Updated successfully"));


    }


    public function render()
    {
        return view('livewire.admin.users.users-edit')->layout('layouts.admins.app');
    }
}
