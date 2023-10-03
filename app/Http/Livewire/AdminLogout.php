<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Auth;
use Livewire\Component;

class AdminLogout extends Component
{

    public function logout() {
        auth()->logout();
        return redirect(route('admin.loginAdmin'));
    }
    public function render()
    {
        return view('livewire.logout');
    }
}
