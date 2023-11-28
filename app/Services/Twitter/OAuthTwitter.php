<?php

namespace App\Services\Twitter;

use Abraham\TwitterOAuth\TwitterOAuth;
use Illuminate\Support\Facades\Log;

class OAuthTwitter implements TwitterInterface
{
    public function __construct(
        protected TwitterOAuth $twitter,
    ) {
    }

    //https://stackoverflow.com/questions/74436471/errors-when-trying-to-tweet-using-tweepy

    public function tweet(string $text): ?array
    {
        $response = $this->twitter->post('tweets', compact('text'), true);

        if ($this->twitter->getLastHttpCode() !== 200) {
            //dd($response);
            Log::error('Error tweet: ' . $this->twitter->getLastHttpCode() . ' ' .  $response->title);

            if ($response->status == 401 || $response->status == 429){
                throw TwitterException::general($this->twitter->getLastHttpCode(), $response?->errors[0]?->message ?? $response->title);
            }

            //{#1931 ▼ // app\Services\Twitter\OAuthTwitter.php:19
            //  +"title": "Forbidden"
            //  +"status": 403
            //  +"detail": "Your client app is not configured with the appropriate oauth1 app permissions for this endpoint."
            //  +"type": "https://api.twitter.com/2/problems/oauth1-permissions"
            //}
            //$msgError =  $response?->detail ?? $response->title . ' '. $response?->reason . $response->detail;
            //You can fix the problem by activating Read / Write in the Oauth section of your application, and then you shall regenerate the "Access Token and Secret".
            //
            //You can check that are properly recreated when you see:
            //
            //Created with Read and Write permissions
            //
            //EDIT as of 10/February/2023: You are now required to ask for Elevated access if you want to have read + write permission. You only have read access from the V2 API Endpoints as of today

            throw TwitterException::general($this->twitter->getLastHttpCode(), $response?->errors[0]?->message ?? $response->title . ' '. $response?->reason);
        }

        return (array) $response;
    }

    //GET /2/users/:id/tweets
    //https://api.twitter.com/2/users/:id/tweets
    //Parameters: max_results, pagination_token, tweet.fields, expansions, media.fields, place.fields, poll.fields, user.fields
    //Response: data, includes, errors, meta
    public function getUserTweets($userTweetId)
    {
        $response = $this->twitter->get('users/' . $userTweetId . '/tweets', [], true);

        if ($this->twitter->getLastHttpCode() !== 200) {
            Log::error('Error getUserTweets: ' . $this->twitter->getLastHttpCode() . ' ' . $response->title);
            Log::channel('slack')->info('Error getUserTweets: ' . $this->twitter->getLastHttpCode() . ' ' . $response->title);

        }

        return (array) $response;
    }

    //DELETE /2/tweets/:id
    //https://api.twitter.com/2/tweets/:id
    //Parameters: ids, expansions, tweet.fields, user.fields
    //Response: data, includes, errors, meta
    public function deleteTweet($tweetId)
    {
        $response = $this->twitter->delete('tweets/' . $tweetId, [], true);

        if ($this->twitter->getLastHttpCode() !== 200) {
            Log::error('Error deleteTweet: ' . $this->twitter->getLastHttpCode() . ' ' .  $response->title);
            Log::channel('slack')->info('Error deleteTweet: ' . $this->twitter->getLastHttpCode() . ' ' . $response->title);

            if ($response->status == 401 || $response->status == 429){
                throw TwitterException::general($this->twitter->getLastHttpCode(), $response?->errors[0]?->message ?? $response->title);
            }
            throw TwitterException::general($this->twitter->getLastHttpCode(), $response?->errors[0]?->message ?? $response->title . ' '. $response?->reason);
        }

        return (array) $response;
    }
    //GET /2/users/me
    //https://api.twitter.com/2/users/me
    //Parameters: expansions, tweet.fields, user.fields
    //Response: data, includes, errors, meta
    public function getUser()
    {
        $response = $this->twitter->get('users/me', [], true);

        if ($this->twitter->getLastHttpCode() !== 200) {
            Log::error('Error getUser: ' . $this->twitter->getLastHttpCode() . ' ' .  $response->title);
            Log::channel('slack')->info('Error getUser: ' . $this->twitter->getLastHttpCode() . ' ' . $response->title);

            if ($response->status == 401 || $response->status == 429){
                throw TwitterException::general($this->twitter->getLastHttpCode(), $response?->errors[0]?->message ?? $response->title);
            }
            throw TwitterException::general($this->twitter->getLastHttpCode(), $response?->errors[0]?->message ?? $response->title . ' '. $response?->reason);
        }

        return (array) $response;
    }



    //following
    //https://api.twitter.com/2/users/:id/following
    public function following($userTweetId, $keyFollow)
    {
        //https://api.twitter.com/2/users/:id/following
        $response = $this->twitter->post('users/' . $userTweetId . '/following', ['target_user_id' => $keyFollow], true);

        if ($this->twitter->getLastHttpCode() !== 200) {
            Log::error('Error following: ' . $this->twitter->getLastHttpCode() . ' ' . $response->title);
            Log::channel('slack')->info('Error following: ' . $this->twitter->getLastHttpCode() . ' ' . $response->title);

            if ($response->status == 401 || $response->status == 429){
                throw TwitterException::general($this->twitter->getLastHttpCode(), $response?->errors[0]?->message ?? $response->title);
            }
            throw TwitterException::general($this->twitter->getLastHttpCode(), $response?->errors[0]?->message ?? $response->title . ' '. $response?->reason);
        }

        return (array) $response;
    }

    //Users a user ID is following
    //Metho Get
    //Endpoint: https://api.twitter.com/2/users/:id/following
    //Parameters: max_results, pagination_token, expansions, tweet.fields, user.fields
    //Response: data, meta
    //Example User ID : 1588364698239397888 Key Follow ID: 1393256216818823169
    public function isFollowing($userTweetId, $keyFollow)
    {
        //https://api.twitter.com/2/users/:id/following
        $response = $this->twitter->get('users/' . $userTweetId . '/following', ['target_user_id' => $keyFollow], true);

        if ($this->twitter->getLastHttpCode() !== 200) {
            Log::error('Error isFollowing: ' . $this->twitter->getLastHttpCode() . ' ' .  $response->title);
            Log::channel('slack')->info('Error isFollowing: ' . $this->twitter->getLastHttpCode() . ' ' . $response->title);

            if ($response->status == 401 || $response->status == 429){
                throw TwitterException::general($this->twitter->getLastHttpCode(), $response?->errors[0]?->message ?? $response->title);
            }
            throw TwitterException::general($this->twitter->getLastHttpCode(), $response?->errors[0]?->message ?? $response->title . ' '. $response?->reason);
        }

        //{
        //  "data": {
        //    "following": true,
        //    "pending_follow": false
        //  }
        //}
        return (array) $response;
    }

    public function like($userTweetId, $keyLike)
    {
        // TODO: Implement like() method.
    }


    //Function getAccessToken
    //Method Post
    //Endpoint: https://api.twitter.com/oauth2/token
    //Parameters: grant_type
    //Response: token_type, access_token
    public function getAccessToken()
    {
        // auth: {
        //   username: config.API_KEY,
        //     password: config.API_KEY_SECRET
        //   }
        $response = $this->twitter->post('oauth2/token', ['grant_type' => 'client_credentials'], true);

        if ($this->twitter->getLastHttpCode() !== 200) {
            Log::error('Error getAccessToken: ' . $this->twitter->getLastHttpCode() . ' ' . $response->title);
            Log::channel('slack')->info('Error getAccessToken: ' . $this->twitter->getLastHttpCode() . ' ' . $response->title);

            if ($response->status == 401 || $response->status == 429){
                throw TwitterException::general($this->twitter->getLastHttpCode(), $response?->errors[0]?->message ?? $response->title);
            }
            throw TwitterException::general($this->twitter->getLastHttpCode(), $response?->errors[0]?->message ?? $response->title . ' '. $response?->reason);
        }

        return (array) $response;
    }

    //Get Single Tweet
    //https://api.twitter.com/2/tweets/:id
    //Parameters: ids, expansions, tweet.fields, user.fields
    //Response: data, includes, errors, meta
    public function getSingleTweet($tweetId)
    {
        $response = $this->twitter->get('tweets/' . $tweetId, [], true);

        if ($this->twitter->getLastHttpCode() !== 200) {
            Log::error('Error getSingleTweet: ' . $this->twitter->getLastHttpCode() . ' ' .  $response->title);
            Log::channel('slack')->info('Error getSingleTweet: ' . $this->twitter->getLastHttpCode() . ' ' . $response->title);

            if ($response->status == 401 || $response->status == 429){
                throw TwitterException::general($this->twitter->getLastHttpCode(), $response?->errors[0]?->message ?? $response->title);
            }
            throw TwitterException::general($this->twitter->getLastHttpCode(), $response?->errors[0]?->message ?? $response->title . ' '. $response?->reason);
        }

        return (array) $response;
    }

    //Get Liked Tweets
    //https://api.twitter.com/2/users/:id/liked_tweets
    //Parameters: max_results, pagination_token, expansions, tweet.fields, user.fields
    //Response: data, meta
    public function getLikedTweets($userTweetId)
    {
        //$userTweetId Required. User ID of the user to request liked Tweets for.
        //set param for max_results
        $arrParam = ['max_results' => 100];
        $response = $this->twitter->get('users/' . $userTweetId . '/liked_tweets', $arrParam, true);

        if ($this->twitter->getLastHttpCode() !== 200) {

            Log::error('Error getLikedTweets: ' . $this->twitter->getLastHttpCode() . ' ' . $response->title);
            Log::channel('slack')->info('Error getLikedTweets: ' . $this->twitter->getLastHttpCode() . ' ' . $response->title);

            if ($response->status == 401 || $response->status == 429){
                throw TwitterException::general($this->twitter->getLastHttpCode(), $response?->errors[0]?->message ?? $response->title);
            }

            throw TwitterException::general($this->twitter->getLastHttpCode(), $response?->errors[0]?->message ?? $response->title . ' '. $response?->reason);
        }
        $dataKey = (array) $response->data;
        //Foreach data get all id key value
        $arrData = [];
        foreach ($dataKey as $key => $value) {
            $arrData[] = $value->id;
        }

        //return (array) $response;
        return $arrData;
    }

    //Check is liked tweet id
    public function isLikedTwitter($userTweetId)
    {
        //$userTweetId Required. User ID of the user to request liked Tweets for.
        $response = $this->twitter->get('users/' . $userTweetId . '/liked_tweets', [], true);

        if ($this->twitter->getLastHttpCode() !== 200) {
            Log::error('Error isLikedTwitter: ' . $this->twitter->getLastHttpCode() . ' ' . $response->title);
            Log::channel('slack')->info('Error getUserByUsername: ' . $this->twitter->getLastHttpCode() . ' ' . $response->title);

            if ($response->status == 401 || $response->status == 429){
                throw TwitterException::general($this->twitter->getLastHttpCode(), $response?->errors[0]?->message ?? $response->title);
            }
            throw TwitterException::general($this->twitter->getLastHttpCode(), $response?->errors[0]?->message ?? $response->title . ' '. $response?->reason);
        }

        return (array) $response;
    }

    //Get User by Username
    //https://api.twitter.com/2/users/by/username/:username
    //Parameters: expansions, tweet.fields, user.fields
    //Response: data, includes, errors, meta
    public function getUserByUsername($username)
    {
        $response = $this->twitter->get('users/by/username/' . $username, [], true);

        if ($this->twitter->getLastHttpCode() !== 200) {
            Log::error('Error getUserByUsername: ' . $this->twitter->getLastHttpCode() . ' ' . $response->title);
            Log::channel('slack')->info('Error getUserByUsername: ' . $this->twitter->getLastHttpCode() . ' ' . $response->title);

            if ($response->status == 401 || $response->status == 429){
                throw TwitterException::general($this->twitter->getLastHttpCode(), $response?->errors[0]?->message ?? $response->title);
            }
            throw TwitterException::general($this->twitter->getLastHttpCode(), $response?->errors[0]?->message ?? $response->title . ' '. $response?->reason);
        }

        //{
        //  "data": {
        //    "id": "2244994945",
        //    "name": "Twitter Dev",
        //    "username": "TwitterDev"
        //  }
        //}
        // "data" => {#1931 ▼
        //    +"id": "1393256216818823169"
        //    +"name": "Larastreamers"
        //    +"username": "larastreamers"
        //  }
        return (array) $response;
    }

    //Retweeted by
    //Get https://api.twitter.com/2/tweets/:id/retweeted_by
    //Parameters: max_results, pagination_token, expansions, tweet.fields, user.fields
    //Response: data, meta
    public function getRetweetedBy($tweetId)
    {
        //$tweetId Required. The Tweet ID of the Tweet to request Retweeting users of.
        $response = $this->twitter->get('tweets/' . $tweetId . '/retweeted_by', [], true);

        if ($this->twitter->getLastHttpCode() !== 200) {
            Log::error('Error getRetweetedBy: ' . $this->twitter->getLastHttpCode() . ' ' . $response->title);
            Log::channel('slack')->info('Error getRetweetedBy: ' . $this->twitter->getLastHttpCode() . ' ' . $response->title);

            if ($response->status == 401 || $response->status == 429){
                throw TwitterException::general($this->twitter->getLastHttpCode(), $response?->errors[0]?->message ?? $response->title);
            }
            throw TwitterException::general($this->twitter->getLastHttpCode(), $response?->errors[0]?->message ?? $response->title . ' '. $response?->reason);

        }
        // "data" => array:98 [▼
        //    0 => {#2534 ▼
        //      +"id": "1588364698239397888"
        //      +"name": "Phan Dung"
        //      +"username": "PhanDun97822241"
        //    }

        $dataKey = (array) $response->data;
        //Foreach data get all id key value
        $arrData = []; //List id user retweeted
        foreach ($dataKey as $key => $value) {
            $arrData[] = $value->id;
        }

        //return (array) $response;
        return $arrData;

        //return (array) $response;
    }

    //Quote Tweets by Tweet ID
    //quote_tweets
    //Get https://api.twitter.com/2/tweets/:id/quote_tweets
    //Parameters: max_results, pagination_token, expansions, tweet.fields, user.fields
    //Response: data, meta
    public function getQuoteTweets($tweetId)
    {
        //$tweetId Required. The Tweet ID of the Tweet to request Retweeting users of.
        $response = $this->twitter->get('tweets/' . $tweetId . '/quote_tweets', [], true);

        if ($this->twitter->getLastHttpCode() !== 200) {
            Log::error('Error getQuoteTweets: ' . $this->twitter->getLastHttpCode() . ' ' . $response->title);
            Log::channel('slack')->info('Error getQuoteTweets: ' . $this->twitter->getLastHttpCode() . ' ' . $response->title);

            if ($response->status == 401 || $response->status == 429){
                throw TwitterException::general($this->twitter->getLastHttpCode(), $response->title);
            }
            throw TwitterException::general($this->twitter->getLastHttpCode(), $response->title . ' '. $response->reason);
        }

        return (array) $response;
    }


}
