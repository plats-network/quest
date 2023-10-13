<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\v1;

use App\Http\Requests\Api\v1\Category\DeleteRequest;
use App\Http\Requests\Api\v1\Category\StoreRequest;
use App\Http\Requests\Api\v1\Category\UpdateAvatarRequest;
use App\Http\Requests\Api\v1\Category\UpdateRequest;
use App\Http\Resources\Api\v1\CategoryCollection;
use App\Http\UseCases\Api\v1\Category\DeleteUseCase;
use App\Http\UseCases\Api\v1\Category\GetCollectionUseCase;
use App\Http\UseCases\Api\v1\Category\GetItemUseCase;
use App\Http\UseCases\Api\v1\Category\StoreUseCase;
use App\Http\UseCases\Api\v1\Category\UpdateAvatarUseCase;
use App\Http\UseCases\Api\v1\Category\UpdateUseCase;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @group User management
 *
 * @authenticated
 */
class CategoryController extends Controller
{
    /**
     * @apiResourceCollection App\Http\Resources\Api\v1\CategoryCollection
     *
     * @apiResourceModel App\Models\User paginate=10
     */
    public function index(Request $request, GetCollectionUseCase $useCase): UserCollection
    {
        return $useCase->handle($request->query() ?? []);
    }

    public function show(User $user, GetItemUseCase $useCase): JsonResponse
    {
        return $useCase->handle($user);
    }

    public function store(StoreRequest $request, StoreUseCase $useCase): JsonResponse
    {
        return $useCase->handle($request->validated());
    }

    public function update(UpdateRequest $request, UpdateUseCase $useCase, User $user): JsonResponse
    {
        return $useCase->handle($user, $request->validated());
    }

    public function updateAvatar(UpdateAvatarRequest $request, UpdateAvatarUseCase $useCase, User $user): JsonResponse
    {
        return $useCase->handle($user, $request->file('avatar'));
    }

    public function destroy(DeleteRequest $request, DeleteUseCase $useCase, User $user): JsonResponse
    {
        return $useCase->handle($user);
    }
}
