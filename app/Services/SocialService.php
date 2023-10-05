<?php
namespace App\Services;

use App\Services\Concerns\BaseService;
use App\Services\Twitter\TwitterApiService;
use App\Repositories\{LocationHistoryRepository, TaskUserRepository};
use Carbon\Carbon;
use App\Helpers\ActionHelper;
use App\Models\{Reward, UserTaskReward};
use Illuminate\Support\Str;

/*
 * Class Social Service
 * @package App\Services
 * */
class SocialService extends BaseService
{
    /**
     * @param $twitterApiService
     * @param $locationHistoryRepository
     */
    public function __construct(
        private TwitterApiService $twitterApiService,
        private TaskUserRepository $taskUserRepository
    ) {}

    /**
     * User start task at location
     * Thực hiện các hành động trên Twitter như like, follow, retweet và tìm kiếm theo hashtag.
     * Sau khi thực hiện xong, cập nhật trạng thái của task thành USER_COMPLETED_TASK
     *
     * @param string $taskId Task ID
     * @param string $socialId Task Social ID
     * @param string $user User
     * @param string $type {FOLLOW, LIKE, RETWEET, TWEET, HASHTAG}
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function performTwitter($user, $twitterUserId, $type = LIKE, $taskId, $userSocial)
    {
        $socialRes = [false, 'Not ' . ActionHelper::getTypeStr($type)[1] . ' Yet?'];
        $key = ($userSocial && $userSocial->url) ? last(explode('/', $userSocial->url)) : null;

        switch((int) $type) {
            case LIKE:
                // url demo: https://twitter.com/NEARProtocol/status/1586347120872808448
                // params {userTweetId, tweetId(1586347120872808448)}
                $socialRes = $this->twitterApiService->isLikes($twitterUserId, $key);
                break;
            case FOLLOW:
                // url demo: https://twitter.com/NEARProtocol
                // params {userTweetId, pageID(NEARProtocol)}
                $socialRes = $this->twitterApiService->isFollowing($twitterUserId, $key);
                break;
            case RETWEET:
                // url demo: https://twitter.com/NEARProtocol/status/1586347120872808448
                // params: {userTweetId}
                $socialRes = $this->twitterApiService->isUserRetweet($twitterUserId, $key);
                break;
            case HASHTAG:
                // params {userTweetId, $key: string | array }
                $text = $userSocial->name . ' ' . $userSocial->description;
                $keys = array_filter(explode(' ', $text), function($txt) {
                    return Str::contains($txt, '#');
                });
                $socialRes = $this->twitterApiService->isHashTag($twitterUserId, $keys);
                break;
            default:
                return $socialRes;
        }

        if ($socialRes[0]) {
            $user = $this->taskUserRepository->firstOrNewSocial($user->id, $taskId, $userSocial->id);
            $user->fill(['status' => USER_COMPLETED_TASK]);
            $user->save();
        }

        return $socialRes;
    }


    /**
     * Start social task
     *
     * @param string $userId
     * @param object $task
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function startTaskSocial($userId, $task)
    {
        foreach($task->taskSocials()->get() as $taskSocial) {
            $user = $this->taskUserRepository
                ->firstOrNewSocial($userId, $task->id, $taskSocial->id);

            if (is_null($user->id) || !$user->id) {
                $user->fill([
                    'status' => USER_PROCESSING_TASK,
                    'started_at' => Carbon::now(),
                    'activity_log' => null
                ]);

                $user->save();
            }
        }

        return;
    }
}
