<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\v1;

use App\Http\Requests\Api\v1\Tag\DeleteRequest;
use App\Http\Requests\Api\v1\Tag\StoreRequest;
use App\Http\Requests\Api\v1\Tag\UpdateAvatarRequest;
use App\Http\Requests\Api\v1\Tag\UpdateRequest;
use App\Http\Resources\Api\v1\TagCollection;
use App\Http\UseCases\Api\v1\Tag\DeleteUseCase;
use App\Http\UseCases\Api\v1\Tag\GetCollectionUseCase;
use App\Http\UseCases\Api\v1\Tag\GetItemUseCase;
use App\Http\UseCases\Api\v1\Tag\StoreUseCase;
use App\Http\UseCases\Api\v1\Tag\UpdateAvatarUseCase;
use App\Http\UseCases\Api\v1\Tag\UpdateUseCase;
use App\Models\Tag;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @group Tag management
 *
 * @authenticated
 */
class TagController extends Controller
{
    /**
     * @apiResourceCollection App\Http\Resources\Api\v1\TagCollection
     *
     * @apiResourceModel App\Models\Tag paginate=10
     */
    public function index(Request $request, GetCollectionUseCase $useCase): TagCollection
    {
        return $useCase->handle($request->query() ?? []);
    }

    public function show(Tag $tag, GetItemUseCase $useCase): JsonResponse
    {
        return $useCase->handle($tag);
    }

    public function store(StoreRequest $request, StoreUseCase $useCase): JsonResponse
    {
        return $useCase->handle($request->validated());
    }

    public function update(UpdateRequest $request, UpdateUseCase $useCase, Tag $tag): JsonResponse
    {
        return $useCase->handle($tag, $request->validated());
    }

    public function updateAvatar(UpdateAvatarRequest $request, UpdateAvatarUseCase $useCase, Tag $tag): JsonResponse
    {
        return $useCase->handle($tag, $request->file('avatar'));
    }

    public function destroy(DeleteRequest $request, DeleteUseCase $useCase, Tag $tag): JsonResponse
    {
        return $useCase->handle($tag);
    }
}
