<?php

namespace App\Services\Traits;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;

trait CollectionPaginationTraitService
{
    /**
     * Paginate collection.
     *
     * @param $items
     * @param int $perPage
     * @param null $page
     * @param string $pageName
     * @return LengthAwarePaginator
     */
    public function paginate($items, $perPage = PAGE_SIZE, $page = null, $pageName = 'page')
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, [
            'path' => LengthAwarePaginator::resolveCurrentPath(),
            'pageName' => $pageName,
        ]);
    }
}
