<?php

declare(strict_types=1);

namespace App\Http\UseCases\Api\v1\Category;

use App\Http\Resources\Api\v1\CategoryCollection;
use App\Models\Category;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

final class GetCollectionUseCase
{
    public function handle(array $query): CategoryCollection
    {
        $categorys = Category::query()
            ->when(! empty($query['search']), function (Builder $q) use ($query) {
                return $q->where('name', 'like', '%'.$query['search'].'%')
                    ->orWhere('email', 'like', '%'.$query['search'].'%');
            })
            ->when(! empty($query['startDate']) && ! empty($query['endDate']), function (Builder $q) use ($query) {
                return $q->whereBetween(DB::raw('date(created_at)'), [$query['startDate'], $query['endDate']]);
            })
            ->orderBy('created_at', 'desc');

        if (! empty($query['limit'])) {
            return new CategoryCollection(
                $categorys->fastPaginate($query['limit'], ['*'], 'page', $query['page'])
            );
        }

        return new CategoryCollection($categorys->get());
    }
}
