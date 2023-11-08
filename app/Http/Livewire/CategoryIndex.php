<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class CategoryIndex extends Component
{
    use WithPagination;

    public $searchTerm;

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $searchTerm = '%' . $this->searchTerm . '%';
        $users = Category::where('name', 'like', $searchTerm)
            ->orWhere('email', 'like', $searchTerm)
            ->orderBy('id', 'desc')
            ->with(['permissions', 'roles', 'providers'])->fastPaginate();

        return view('livewire.category-index', compact('users'));
    }
}
