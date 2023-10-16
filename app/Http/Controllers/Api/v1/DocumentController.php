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
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @group Category management
 *
 * @authenticated
 */
class DocumentController extends Controller
{
    /**
     * @apiResourceCollection App\Http\Resources\Api\v1\CategoryCollection
     *
     * @apiResourceModel App\Models\Category paginate=10
     */
    public function index(Request $request, GetCollectionUseCase $useCase): CategoryCollection
    {
        return $useCase->handle($request->query() ?? []);
    }

}
