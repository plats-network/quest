<?php

namespace App\Http\Livewire;

use App\Models\Post;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class PostsIndex extends Component
{
    use WithPagination;

    public $searchTerm;

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $searchTerm = '%' . $this->searchTerm . '%';
        $users = Post::where('name', 'like', $searchTerm)
            ->orWhere('email', 'like', $searchTerm)
            ->orderBy('id', 'desc')
            ->with(['permissions', 'roles', 'providers'])->fastPaginate();

        return view('livewire.posts-index', compact('users'));
    }
}
