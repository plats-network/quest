<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\v1;

use App\Http\Requests\Api\v1\Task\DeleteRequest;
use App\Http\Requests\Api\v1\Task\StoreRequest;
use App\Http\Requests\Api\v1\Task\UpdateAvatarRequest;
use App\Http\Requests\Api\v1\Task\UpdateRequest;
use App\Http\Resources\Api\v1\TaskCollection;
use App\Http\UseCases\Api\v1\Task\DeleteUseCase;
use App\Http\UseCases\Api\v1\Task\GetCollectionUseCase;
use App\Http\UseCases\Api\v1\Task\GetItemUseCase;
use App\Http\UseCases\Api\v1\Task\StoreUseCase;
use App\Http\UseCases\Api\v1\Task\UpdateAvatarUseCase;
use App\Http\UseCases\Api\v1\Task\UpdateUseCase;
use App\Models\Task;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @group Task management
 *
 * @authenticated
 */
class TaskController extends Controller
{
    /**
     * @apiResourceCollection App\Http\Resources\Api\v1\TaskCollection
     *
     * @apiResourceModel App\Models\Task paginate=10
     */
    public function index(Request $request, GetCollectionUseCase $useCase): TaskCollection
    {
        return $useCase->handle($request->query() ?? []);
    }

    public function show(Task $task, GetItemUseCase $useCase): JsonResponse
    {
        return $useCase->handle($task);
    }

    public function store(StoreRequest $request, StoreUseCase $useCase): JsonResponse
    {
        return $useCase->handle($request->validated());
    }

    public function update(UpdateRequest $request, UpdateUseCase $useCase, Task $task): JsonResponse
    {
        return $useCase->handle($task, $request->validated());
    }

    public function updateAvatar(UpdateAvatarRequest $request, UpdateAvatarUseCase $useCase, Task $task): JsonResponse
    {
        return $useCase->handle($task, $request->file('avatar'));
    }

    public function destroy(DeleteRequest $request, DeleteUseCase $useCase, Task $task): JsonResponse
    {
        return $useCase->handle($task);
    }
}
