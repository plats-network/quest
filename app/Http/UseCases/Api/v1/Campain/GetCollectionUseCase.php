<?php

declare(strict_types=1);

namespace App\Http\UseCases\Api\v1\Campain;

use App\Http\Resources\Api\v1\CampainCollection;
use App\Models\Post as Campain;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

final class GetCollectionUseCase
{
    public function handle(array $query): CampainCollection
    {
        $campains = Campain::query()
            ->when(! empty($query['search']), function (Builder $q) use ($query) {
                return $q->where('name', 'like', '%'.$query['search'].'%')
                    ->orWhere('email', 'like', '%'.$query['search'].'%');
            })
            ->when(! empty($query['startDate']) && ! empty($query['endDate']), function (Builder $q) use ($query) {
                return $q->whereBetween(DB::raw('date(created_at)'), [$query['startDate'], $query['endDate']]);
            })
            ->orderBy('created_at', 'desc');

        //Filter by user created_by
        $user = auth('sanctum')->user();
        if ($user){
            if ($user->role === 'user') {
                $campains->where('created_by', $user->id);
            }
        }else{
            $campains->where('created_by', 0);
        }

        if (! empty($query['created_by'])) {
            $campains->where('created_by', $query['created_by']);
        }
        if (! empty($query['limit'])) {
            return new CampainCollection(
                $campains->fastPaginate($query['limit'], ['*'], 'page', $query['page'])
            );
        }

        return new CampainCollection($campains->get());
    }
}
