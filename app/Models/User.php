<?php

namespace App\Models;

use Illuminate\Support\Facades\Http;
use App\Models\Presenters\UserPresenter;
use App\Models\Traits\HasHashedMediaTrait;
use App\Services\Twitter\TwitterApiService;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Permission\Traits\HasRoles;
use Overtrue\LaravelFavorite\Traits\Favoriter;
use Noweh\TwitterApi\Client;
use App\Facades\Twitter;
use Telegram\Bot\Laravel\Facades\Telegram;

/**
 * @property integer $id
 * @property string $first_name
 * @property string $last_name
 * @property string $gender
 * @property string $email
 * @property string $password
 * @property string $pin
 * @property boolean $default_pin
 * @property string $address
 * @property string $number
 * @property string $city
 * @property string $avatar_url
 * @property string $ZIP
 * @property string $email_verified_at
 * @property string $phone
 * @property string $role
 * @property string $social_id
 * @property string $social_type
 * @property string $facebook_id
 * @property string $google_id
 * @property string $github_id
 * @property string $twitter_id
 * @property string $telegram_id
 * @property string $discord_id
 * @property string $twitter_username
 * @property string $telegram_username
 * @property string $discord_username
 * @property string $contact_name
 * @property string $company_name
 * @property string $website
 * @property boolean $enable_portal
 * @property integer $currency_id
 * @property string $name
 * @property string $username
 * @property string $mobile
 * @property string $date_of_birth
 * @property string $avatar
 * @property boolean $status
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 * @property integer $creator_id
 * @property integer $wallet_address
 * @property integer $wallet_name
 * @property string $guard_name
 * @property string $remember_token
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property string $stripe_id
 * @property string $pm_type
 * @property string $pm_last_four
 * @property string $trial_ends_at
 * @property OldPin[] $oldPins
 * @property RequirePin[] $requirePins
 */
class User extends Authenticatable implements HasMedia, MustVerifyEmail, JWTSubject
{
    use HasFactory;
    use HasHashedMediaTrait;
    use HasRoles;
    use Notifiable;
    use SoftDeletes;
    use UserPresenter;

    use Favoriter;

    use HasApiTokens;

    //Type gender Female
    const GENDER_MALE = 'Male';
    //Female
    const GENDER_FEMALE = 'Female';
    const GENDER_OTHER = 'Other';

    const ROLE_ADMIN = 'admin';
    const ROLE_USER = 'user';
    const ROLE_SALE = 'sale';

    protected $guarded = [
        'id',
        'updated_at',
        '_token',
        '_method',
        'password_confirmation',
    ];

    protected $casts = [
        'deleted_at' => 'datetime',
        'date_of_birth' => 'datetime',
        'email_verified_at' => 'datetime',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $fillable = [
        'name',
        'email',
        'password',
        'wallet_address',
        'wallet_name',
        'stripe_id',
        'avatar_url',
        'pm_type',
        'pm_last_four',
        'trial_ends_at',
        'social_id',
        'social_type',
        'twitter_id',
        'twitter_username',
    ];

    protected static function boot()
    {
        parent::boot();

        // create a event to happen on creating
        static::creating(function ($table) {
            $table->created_by = auth()->id();
        });

        // create a event to happen on updating
        static::updating(function ($table) {
            $table->updated_by = auth()->id();
        });

        // create a event to happen on saving
        static::saving(function ($table) {
            $table->updated_by = auth()->id();
        });

        // create a event to happen on deleting
        static::deleting(function ($table) {
            $table->deleted_by = auth()->id();
            $table->save();
        });
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function providers()
    {
        return $this->hasMany(UserProvider::class);
    }

    //Twiter Infor
    //Get twitter id from user provider
    public function getTwitterIdNewAttribute()
    {
        if ($this->twitter_id){
            return $this->twitter_id;
        }

        return $this->providers()->where('provider', 'twitter')->first()->provider_id ?? null;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function profile()
    {
        return $this->hasOne(Userprofile::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function userprofile()
    {
        return $this->hasOne(Userprofile::class);
    }

    /**
     * Get the list of users related to the current User.
     *
     * @return [array] roels
     */
    public function getRolesListAttribute()
    {
        return array_map('intval', $this->roles->pluck('id')->toArray());
    }

    /**
     * Route notifications for the Slack channel.
     *
     * @param \Illuminate\Notifications\Notification $notification
     * @return string
     */
    public function routeNotificationForSlack($notification)
    {
        return env('SLACK_NOTIFICATION_WEBHOOK');
    }

    public function hasRole(string $role): bool
    {
        return true;
        //return $this->role === $role;
    }

    public static function findByIdOrEmail(string|int $identifier)
    {
        return User::query()
            ->where('id', $identifier)
            ->orWhere('email', $identifier)
            ->first();
    }

    //https://fajarwz.com/blog/laravel-rest-api-authentication-using-jwt-tutorial/

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    //hasTwitterFollowed
    public function hasTwitterFollowed($username)
    {
        //Check if user has followed
        //Call Twitter API

        $twitterApiService = new TwitterApiService();
        $twitterUserId = 1588364698239397888;
        $key = 'NEARProtocol';

        //Not check
        //$socialRes = $twitterApiService->isFollowing($twitterUserId, $key);

        //dd($socialRes);

        return true;
    }

    //hasTwitterRetweeted
    public function hasTwitterRetweeted($twitter_targetID)
    {
        //Check if user has Retweeted

        $twitterUserID = $this->twitter_id; //1588364698239397888

        $isDone = false;

        $responseIDS = Twitter::getRetweetedBy($twitter_targetID);
        Log::info('Call api tweets', [
            'code' => $responseIDS
        ]);
        //Check if user has liked that $twitter_targetID in array $responseIDSLike
        if (in_array($twitterUserID, $responseIDS)) {
            $isDone = true;
        }else{
            Log::info('User has not retweeted', [
                'code' => $responseIDS
            ]);
        }

        return $isDone;
    }

    //hasTwitterHashtag
    public function hasTwitterHashtag($keyHashTag)
    {
        //Check if user has Retweeted
        $text = "#WordCup   Update";
        //'dd(Str::contains($text, '#WordCup'));


        $twitterUserID = $this->twitter_id;
        //arr $keyHashTag ex: ['NEARProtocol', 'NEARProtocol2']
        $arrKeyHashTag = explode(',', $keyHashTag);

        $isDone = false;
        //Call Twitter API Get list tweets by user id
        $responseIDS = Twitter::getUserTweets($twitterUserID);
        Log::info('Call api tweets', [
            'code' => $responseIDS
        ]);
        //Check if user has hashtag that $keyHashTag in array $responseIDS
        //foreach($data->data as $item) {
        //    $contains = Str::contains($item->text, $key);
        //
        //    if ($contains) {
        //            return $resultSuccess;
        //          }
        //       }

        if (isset($responseIDS['data'])) {
            foreach ($responseIDS['data'] as $item) {
                foreach ($arrKeyHashTag as $valueHastag){
                    $contains = Str::contains($item->text, $valueHastag);

                    if ($contains) {
                        $isDone = true;
                    }
                }

            }
        }else{
            Log::info('User has not hashtag', [
                'code' => $responseIDS
            ]);
        }

        return $isDone;
    }

    //hasTwitterLiked
    public function hasTwitterLiked($twitter_targetID)
    {
        //Check if user has followed
        //Call Twitter API
        $isLike = false;

        $twitterApiService = new TwitterApiService();
        //$twitterUserID = 1588364698239397888;

        $twitterUserID = $this->twitter_id;
        $key = 'NEARProtocol';

        //$socialRes = $twitterApiService->isLiked($twitterUserID, $key);
        //dd($socialRes);

        $responseIDSLike = Twitter::getLikedTweets($twitterUserID);
        //Check if user has liked that $twitter_targetID in array $responseIDSLike
        if (in_array($twitter_targetID, $responseIDSLike)) {
            $isLike = true;
        }else{
            Log::info('User has not liked', [
                'code' => $responseIDSLike
            ]);
        }

        return $isLike;
    }

    //Check join telegram channel/ group
    public function hasTelegramJoined($channelName)
    {
        //Check if user has joined
        //Call Telegram API
        $isJoin = false;
        $telegramUserID = $this->telegram_id;
        $key = 'NEARProtocol';

        //$socialRes = $twitterApiService->isLiked($twitterUserID, $key);
        //dd($socialRes);

        //Call Telegram API Get list channel by user id
        $responseIDS = Telegram::getUserChannels($telegramUserID);
        //Check if user has liked that $twitter_targetID in array $responseIDSLike
        if (in_array($channelName, $responseIDS)) {
            $isJoin = true;
        }else{
            Log::info('User has not joined', [
                'code' => $responseIDS
            ]);
        }

        return $isJoin;
    }

    //hasTokenHolder
    public function hasTokenHolder($networkName, $totalToken)
    {
        //Call api Check accoutn
        //http://209.97.161.136:8000/check-account?accountId=YQnbw3h6couUX48Ghs3qyzhdbyxA3Gu9KQCoi8z2CPBf9N3&chainId=phala
        //Param accountId chainId
        //Return true or false
        $wallet_address = $this->wallet_address;
        //$networkName to lower
        $networkName = strtolower($networkName);
        //Call
        $url = 'http://209.97.161.136:8000/check-account?accountId=' . $wallet_address . '&chainId=' . $networkName;

        Log::info('Url Token Holder Check ' . $url);
        $dataReturn = [
            'status' => false,
            'message' => 'Check account fail'
        ];
        try {
            $response = Http::timeout(30)->get($url);
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::info('Conect to server fail');
            $dataReturn['message'] = 'Conect to server fail URL: ' . $url ;;
            $dataReturn['status'] = false;
            return $dataReturn;
        }
        //{
        //    "success": true,
        //    "data": {
        //        "balance": "0.00000"
        //    }
        //}
        //{
        //    "message": {
        //        "balance": 0
        //    }
        //}
        $res = $response->json();
        $dataReturn['data'] = $res;
        $dataReturn['url_call'] = $url;
        Log::info('Check account', $res);
        //Check wallet balance > totalToken
        if ($res['success'] == true) {
            $balance = $res['data']['balance'];
            if ($balance >= $totalToken) {
                $dataReturn['message'] = 'Has token holder';
                $dataReturn['status'] = true;
            }else{
                $dataReturn['message'] = 'Has not token holder';
                $dataReturn['status'] = false;
            }
        }

        return $dataReturn;
    }

    public function hasTransactionActivity($networkName, $totalToken)
    {
        //Call api Check accoutn
        //http://209.97.161.136:8000/info-transfer?accountId=F3opxRbMKKF5x3YyiodUPKUsZJq8j8enDPvqH2MQqw1C7i7&chainId=phala
        //Param accountId chainId
        //Return true or false
        $wallet_address = $this->wallet_address;
        //$wallet_address = 'F3opxRbMKKF5x3YyiodUPKUsZJq8j8enDPvqH2MQqw1C7i7';
        //$networkName to lower
        $networkName = strtolower($networkName);
        //Call
        $url = 'http://209.97.161.136:8000/info-transfer?accountId=' . $wallet_address . '&chainId=' . $networkName;
        Log::info('Url Token Holder Check ' . $url);

        $dataReturn = [
            'status' => false,
            'message' => 'Check account fail'
        ];
        try {
            $response = Http::timeout(30)->get($url);
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::info('Conect to server fail');
            $dataReturn['message'] = 'Conect to server fail URL' . $url ;
            $dataReturn['status'] = false;

            return $dataReturn;
        }

        //{
        //    "success": true,
        //    "data": {
        //        "amount": "0.36975",
        //        "timestamp": "2023-10-09T13:20:49.096Z"
        //    }
        //}
        $res = $response->json();

        $dataReturn['data'] = $res;
        $dataReturn['url_call'] = $url;

        Log::info('Check trasfer', $res);

        //Check wallet balance > totalToken
        if ($res['success'] == true) {
            $balance = $res['data']['amount'];
            if ($balance >= $totalToken) {
                $dataReturn['message'] = 'Has token holder';
                $dataReturn['status'] = true;
            }else{
                $dataReturn['message'] = 'Has not token holder';
                $dataReturn['status'] = false;
            }
        }
        //Fail
        //"success" => false
        //  "message" => "No transfer records found for the given account ID."

        return $dataReturn;
    }

    public function hasTwitterFollowed2($username)
    {
        //Check if user has followed
        //Call Twitter API

        $settings = [
            'account_id' => 'czBDWnh3TzAwenBDUFE0NXhIcUY6MTpjaQ',

            'access_token' => '4367425814-CNFG76nKC8d015vLKahxC4KT70Q4hIsGUnFRhj1',
            'access_token_secret' => 'pdYQB5xSPkkSE6LLtRDPmeUZZHHUHOLeY3YY1R2ynzeS8',

            // 'access_token' => 'n4mU9cOsweKWnth4kyJeS1XkI',
            //'access_token_secret' => 'HDhe6ZZPvK96SwBGwAj4YrYPWmSnUluv6oMjevMECbahNLgAOA',

            'consumer_key' => 'f6YoruRt1MotL8sfr7T465Yna',
            'consumer_secret' => 'vR9y289BIp7RkP3DRsd5d2xcJho1sUEPaHVsukv63hKTaqe5Vm',

            'bearer_token' => 'AAAAAAAAAAAAAAAAAAAAAF7iqgEAAAAAc8htvpiOeEzvejxjq2lHezKk2pw%3DIrpZB5LFxdbceFa2NJ3ITkxXJrC3h1lllpzFz22VSWLTUmZlOD',

        ];

        $client = new Client($settings);
        //$return = $client->userMeLookup()->performRequest();
        $return = $client->userFollows()->getFollowers()->performRequest();
        //$return = $client->timeline()->getRecentMentions('1588364698239397888')->performRequest();
        //Retrieve the users which you are following
        //Example:
        //
        //$return = $client->userFollows()->getFollowing()->performRequest();

        dd($return);

        /*   $response = $client->tweet()->create()
               ->performRequest([
                   'text' => 'Test Tweet... '
               ],
                   withHeaders: true
               )
           ;
           dd($response);*/

        return false;
    }

    //https://shuffle.dev/wrexa-assets/images/avatar-male2.png
    //https://shuffle.dev/wrexa-assets/images/avatar-women1.png
    //https://images.unsplash.com/photo-1456327102063-fb5054efe647?ixlib=rb-1.2.1&auto=format&fit=crop&w=128&q=60
    /*
     * Retweet a Tweet
     * Example:
     * $return = $client->retweet()->performRequest(['tweet_id' => $tweet_id]);
     * */

    public function getUserName()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    //Get total post user task
    public function getTotalPostUserTask($post_id)
    {
        $total = 0;
        $userTask = UserTaskStatus::where('user_id', $this->id)
            ->where('post_id', $post_id)
            ->get();
        foreach ($userTask as $task) {
            //$total += $task->total_point;
            $total += 1;
        }
        return $total;
    }


}
