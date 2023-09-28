<?php

namespace App\Traits;

use Livewire\WithPagination;

class WithPerPagePagination
{
    use WithPagination;

    public $perPage = 10;

    public function mountWithPerPagePagination()
    {
        $this->perPage = session()->get('perPage', $this->perPage);
    }

    public function updatedPerPage($value)
    {
        session()->put('perPage', $value);
    }

    public function applyPagination($query)
    {
        return $query->fastPaginate($this->perPage);
    }
}
