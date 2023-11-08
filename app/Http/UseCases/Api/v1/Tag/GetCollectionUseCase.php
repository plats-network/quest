<?php

declare(strict_types=1);

namespace App\Http\UseCases\Api\v1\Tag;

use App\Http\Resources\Api\v1\TagCollection;
use App\Models\Tag;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

final class GetCollectionUseCase
{
    public function handle(array $query): TagCollection
    {
        $tags = Tag::query()
            ->when(! empty($query['search']), function (Builder $q) use ($query) {
                return $q->where('name', 'like', '%'.$query['search'].'%')
                    ->orWhere('email', 'like', '%'.$query['search'].'%');
            })
            /*->when(! empty($query['startDate']) && ! empty($query['endDate']), function (Builder $q) use ($query) {
                return $q->whereBetween(DB::raw('date(created_at)'), [$query['startDate'], $query['endDate']]);
            })*/
            ->orderBy('created_at', 'desc');

        if (! empty($query['limit'])) {
            return new TagCollection(
                $tags->fastPaginate($query['limit'], ['*'], 'page', $query['page'])
            );
        }

        return new TagCollection($tags->get());
    }
}
