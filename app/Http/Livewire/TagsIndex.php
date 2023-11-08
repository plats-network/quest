<?php

namespace App\Http\Livewire;

use App\Models\Tag;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class TagsIndex extends Component
{
    use WithPagination;

    public $searchTerm;

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $searchTerm = '%' . $this->searchTerm . '%';

        $users = Tag::where('name', 'like', $searchTerm)
            ->orWhere('email', 'like', $searchTerm)
            ->orderBy('id', 'desc')
            ->with(['permissions', 'roles', 'providers'])->fastPaginate();

        return view('livewire.users-index', compact('users'));
    }
}
