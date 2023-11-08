<?php

declare(strict_types=1);

namespace App\Http\UseCases\Api\v1\Task;

use App\Http\Resources\Api\v1\TaskCollection;
use App\Models\Task;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

final class GetCollectionUseCase
{
    public function handle(array $query): TaskCollection
    {
        $campain_id = Arr::get($query, 'post_id', null);
        $tasks = Task::query()
            ->when(! empty($query['search']), function (Builder $q) use ($query) {
                return $q->where('name', 'like', '%'.$query['search'].'%')
                    ->orWhere('email', 'like', '%'.$query['search'].'%');
            })
            ->where('post_id', $campain_id)
            /*->when(! empty($query['startDate']) && ! empty($query['endDate']), function (Builder $q) use ($query) {
                return $q->whereBetween(DB::raw('date(created_at)'), [$query['startDate'], $query['endDate']]);
            })*/
            ->orderBy('created_at', 'desc');

        if (! empty($query['limit'])) {
            return new TaskCollection(
                $tasks->fastPaginate($query['limit'], ['*'], 'page', $query['page'])
            );
        }

        return new TaskCollection($tasks->get());
    }
}
