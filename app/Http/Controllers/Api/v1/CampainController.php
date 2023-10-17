<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\v1;

use App\Http\Requests\Api\v1\Campain\DeleteRequest;
use App\Http\Requests\Api\v1\Campain\StoreRequest;
use App\Http\Requests\Api\v1\Campain\UpdateAvatarRequest;
use App\Http\Requests\Api\v1\Campain\UpdateRequest;
use App\Http\Resources\Api\v1\CampainCollection;
use App\Http\UseCases\Api\v1\Campain\DeleteUseCase;
use App\Http\UseCases\Api\v1\Campain\GetCollectionUseCase;
use App\Http\UseCases\Api\v1\Campain\GetItemUseCase;
use App\Http\UseCases\Api\v1\Campain\StoreUseCase;
use App\Http\UseCases\Api\v1\Campain\UpdateAvatarUseCase;
use App\Http\UseCases\Api\v1\Campain\UpdateUseCase;
use App\Models\Post as Campain;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @group Campain management
 *
 * @authenticated
 */
class CampainController extends Controller
{
    /**
     * @apiResourceCollection App\Http\Resources\Api\v1\CampainCollection
     *
     * @apiResourceModel App\Models\Campain paginate=10
     */
    public function index(Request $request, GetCollectionUseCase $useCase): CampainCollection
    {
        return $useCase->handle($request->query() ?? []);
    }

    public function show(Campain $campain, GetItemUseCase $useCase): JsonResponse
    {
        //Show detail campain
        return $useCase->handle($campain);
    }

    public function store(StoreRequest $request, StoreUseCase $useCase): JsonResponse
    {
        return $useCase->handle($request->validated());
    }

    public function update(UpdateRequest $request, UpdateUseCase $useCase, Campain $campain): JsonResponse
    {
        return $useCase->handle($campain, $request->validated());
    }

    public function updateAvatar(UpdateAvatarRequest $request, UpdateAvatarUseCase $useCase, Campain $campain): JsonResponse
    {
        return $useCase->handle($campain, $request->file('avatar'));
    }

    public function destroy(DeleteRequest $request, DeleteUseCase $useCase, Campain $campain): JsonResponse
    {
        return $useCase->handle($campain);
    }
}
