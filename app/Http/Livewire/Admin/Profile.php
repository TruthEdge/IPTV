<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class Profile extends Component
{
    public  $user, $roles = [];

    function mount($id)
    {
        $user = User::findOrFail($id);
        $this->user = $user->toArray();
    }

    public function update()
    {

        $this->validate([
            'user.name' => 'required',
            'user.mobile' => '',
            'user.id_number' => '',
            'user.nationality' => '',
            'user.email' => 'email|unique:users,email,' . $this->user['id'],
            'user.gym' => '',
            'user.weight' => '',
            'user.gender' => 'required',
            'user.birth_date' => '',
            'user.place_birth' => '',
            'user.location_id' => '',

        ]);

//        if ($this->user['password']) {
//            $this->validate([
//                'password' => 'required|min:6',
//            ]);
//        }

        $user = User::findOrFail($this->user['id']);

//
//        if ($this->user['password']) {
//            $user['password'] = bcrypt($this->user['password']);
//            $user->save();
//        }


        $user->update($this->user);



        session()->flash('success', 'User successfully Updated.');

        return redirect()->route('admin.home');
    }

    public function render()
    {
        return view('livewire.admin.profile')->layout('layouts.admins.app');
    }
}
