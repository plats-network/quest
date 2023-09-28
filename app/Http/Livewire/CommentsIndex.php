<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class CommentsIndex extends Component
{
    use WithPagination;

    public $searchTerm;

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $searchTerm = '%' . $this->searchTerm . '%';
        $users = Component::where('name', 'like', $searchTerm)
            ->orWhere('email', 'like', $searchTerm)
            ->orderBy('id', 'desc')
            ->with(['permissions', 'roles', 'providers'])->paginate();

        return view('livewire.comments-index', compact('users'));
    }
}
