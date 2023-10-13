<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\v1;

use App\Http\Requests\Api\v1\Comment\DeleteRequest;
use App\Http\Requests\Api\v1\Comment\StoreRequest;
use App\Http\Requests\Api\v1\Comment\UpdateAvatarRequest;
use App\Http\Requests\Api\v1\Comment\UpdateRequest;
use App\Http\Resources\Api\v1\CommentCollection;
use App\Http\UseCases\Api\v1\Comment\DeleteUseCase;
use App\Http\UseCases\Api\v1\Comment\GetCollectionUseCase;
use App\Http\UseCases\Api\v1\Comment\GetItemUseCase;
use App\Http\UseCases\Api\v1\Comment\StoreUseCase;
use App\Http\UseCases\Api\v1\Comment\UpdateAvatarUseCase;
use App\Http\UseCases\Api\v1\Comment\UpdateUseCase;
use App\Models\Comment;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @group Comment management
 *
 * @authenticated
 */
class CommentController extends Controller
{
    /**
     * @apiResourceCollection App\Http\Resources\Api\v1\CommentCollection
     *
     * @apiResourceModel App\Models\Comment paginate=10
     */
    public function index(Request $request, GetCollectionUseCase $useCase): CommentCollection
    {
        return $useCase->handle($request->query() ?? []);
    }

    public function show(Comment $comment, GetItemUseCase $useCase): JsonResponse
    {
        return $useCase->handle($comment);
    }

    public function store(StoreRequest $request, StoreUseCase $useCase): JsonResponse
    {
        return $useCase->handle($request->validated());
    }

    public function update(UpdateRequest $request, UpdateUseCase $useCase, Comment $comment): JsonResponse
    {
        return $useCase->handle($comment, $request->validated());
    }

    public function updateAvatar(UpdateAvatarRequest $request, UpdateAvatarUseCase $useCase, Comment $comment): JsonResponse
    {
        return $useCase->handle($comment, $request->file('avatar'));
    }

    public function destroy(DeleteRequest $request, DeleteUseCase $useCase, Comment $comment): JsonResponse
    {
        return $useCase->handle($comment);
    }
}
