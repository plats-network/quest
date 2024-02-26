<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\v1;

use App\Http\Requests\Api\v1\User\DeleteRequest;
use App\Http\Requests\Api\v1\User\StoreRequest;
use App\Http\Requests\Api\v1\User\UpdateAvatarRequest;
use App\Http\Requests\Api\v1\User\UpdateRequest;
use App\Http\Resources\Api\v1\UserCollection;
use App\Http\UseCases\Api\v1\User\DeleteUseCase;
use App\Http\UseCases\Api\v1\User\GetCollectionUseCase;
use App\Http\UseCases\Api\v1\User\GetItemUseCase;
use App\Http\UseCases\Api\v1\User\StoreUseCase;
use App\Http\UseCases\Api\v1\User\UpdateAvatarUseCase;
use App\Http\UseCases\Api\v1\User\UpdateUseCase;
use App\Models\ReferralRelationship;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * @group User management
 *
 * @authenticated
 */
class UserController extends Controller
{
    /**
     * @apiResourceCollection App\Http\Resources\Api\v1\UserCollection
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

    //updateUserProfile
    public function updateUserProfile(Request $request, UpdateUseCase $useCase, User $user): JsonResponse
    {

        return $useCase->handle($user, $request->all());
    }

    public function destroy(DeleteRequest $request, DeleteUseCase $useCase, User $user): JsonResponse
    {
        return $useCase->handle($user);
    }

    //getTop5UserReferal
    public function getTop5UserReferal(Request $request): JsonResponse
    {

        //$modelAdd = \App\Models\ReferralRelationship::create([
        //                'referral_link_id' => $referral->id,
        //                'user_id' => $user->id
        //            ]);

        //Find top 5 user have more referal
        //From ReferralRelationship
        //Group by user_id
        //Count user_id
        //Order by count user_id desc
        //Limit 5

        $Top5UserReferal = ReferralRelationship::query()
            ->select('referral_link_id', DB::raw('count(referral_link_id) as total_referal'))
            ->groupBy('referral_link_id')
            ->orderBy('total_referal', 'desc')
            ->limit(5)
            ->get();

        $dataReturn = [];
        foreach ($Top5UserReferal as $Item){
            ///Get referral_link then get user_id
            $referalLink = \App\Models\ReferralLink::query()
                ->where('id', '=', $Item->referral_link_id)
                ->first();

            $modelUser = User::query()
                ->where('id', '=', $referalLink->user_id)
                ->first();

            $dataSet = [
                'user_id' => $modelUser->id,
                'wallet_address' => $modelUser->wallet_address??'',
                'total_referal' => $Item->total_referal
            ];

            $dataReturn[] = $dataSet;

        }


        return response()->json(
            [
                'status' => 'success',
                'total_reward' => count($dataReturn),
                'data' => $dataReturn
            ]
        );
    }
}
