<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

/*
 * Class ActionHelper
 * */
class ActionHelper
{
    /**
     *
     * @param  string|null  $tpye
     * @return int|null
     */
    public static function getTypeTwitter($tpye): ?string
    {
        switch($tpye) {
            case 'follow':
                $tweetType = FOLLOW;
                break;
            case 'retweet':
                $tweetType = RETWEET;
                break;
            case 'tweet':
                $tweetType = TWEET;
                break;
            case 'hashtag';
                $tweetType = HASHTAG;
                break;
            default:
                $tweetType = LIKE;
        }

        return $tweetType;
    }

    /**
     *
     * @param  integer|null $tpye
     * @return string|null
     */
    public static function getTypeStr($tpye)
    {
        $datas = [];
        switch($tpye) {
            case FOLLOW:
                $datas = ['follow', 'Follow'];
                break;
            case RETWEET:
                $datas = ['retweet', 'Retweet'];
                break;
            case TWEET:
                $datas = ['tweet', 'Tweet'];
                break;
            case HASHTAG:
                $datas = ['hashtag', 'Hashtag'];
                break;
            default:
                $datas = ['like', 'Like'];
        }

        return $datas;
    }

    /**
     *
     * @param  integer|null $tpye
     * @return string|null
     */
    public static function getUrlIntent($tpye, $url, $txtTag = '')
    {
        $urlTwitter = 'https://twitter.com/intent';
        $urlIntent = $url ? last(explode('/', $url)) : null;
        $datas = [];
        switch($tpye) {
            case FOLLOW:
                $data = $urlTwitter . '/follow?screen_name=' . $urlIntent;
                break;
            case RETWEET:
                $data = $urlTwitter . '/retweet?tweet_id=' . $urlIntent;
                break;
            case TWEET:
            case HASHTAG:
                $data = $urlTwitter . '/tweet?hashtags=' . $txtTag;
                break;
            default:
                $data = $urlTwitter . '/like?tweet_id=' . $urlIntent;
        }

        return $data;
    }

    /**
     *
     * @param  string|null  $tpye
     * @return int|null
     */
    public static function iconSocial($platform)
    {
        $s3 = Storage::disk('s3');
        switch($platform) {
            case TWITTER:
                $icon = $s3->url('icon/tweeter.png');
                break;
            case FACEBOOK:
                $icon = $s3->url('icon/facebook.png');
                break;
            case DISCORD:
                $icon = $s3->url('icon/discord.png');
                break;
            default:
                $icon = $s3->url('icon/telegram.png');
        }

        return $icon;
    }

    public static function getType($type = 0)
    {
        // define('TYPE_CHECKIN', 1);
        // define('TYPE_INSTALL_APP', 2);
        // define('TYPE_VIDEO_WATCH', 3);
        // define('TYPE_SOCIAL', 4);

        switch($type) {
            case TYPE_CHECKIN:
                $txtType = 'checkin';
                break;
            case TYPE_INSTALL_APP:
                $txtType = 'install-app';
                break;
            case TYPE_VIDEO_WATCH:
                $txtType = 'video-watch';
                break;
            default:
                $txtType = 'social';
        }

        return $txtType;
    }


    // /**
    //  * Tasks type platform
    //  */
    // define('TWITTER', 1);
    // define('FACEBOOK', 2);
    // define('DISCORD', 3);
    // define('TELEGRAM', 4);

    // // Twitter
    // define('TWITTER_FOLLOW', 0);
    // define('TWITTER_LIKE', 1);
    // define('TWITTER_RETWEET', 2);
    // define('TWITTER_TWEET', 3);

    // // Facebook
    // define('FACEBOOK_SHARE', 0);
    // define('FACEBOOK_LIKE', 1);
    // define('FACEBOOK_POST', 2);
    // define('FACEBOOK_JOIN_GROUP', 3);

    // // Telegram
    // define('TELEGRAM_JOIN', 0);

    // // Discord
    // define('DISCORD_JOIN', 0);

    public static function commonType($platform, $type)
    {
        $labelPlatform = '';
        $label = '';

        if ($platform == FACEBOOK) {
            $labelPlatform = 'facebook';

            if ($type == FACEBOOK_SHARE) {
                $label = 'share';
            } elseif ($type == FACEBOOK_LIKE) {
                $label = 'like';
            } elseif ($type == FACEBOOK_POST) {
                $label = 'post';
            } else {
                $label = 'join_group';
            }
        } elseif ($platform == DISCORD) {
            $labelPlatform = 'discord';
            $label = 'join';
        } elseif ($platform == TELEGRAM) {
            $labelPlatform = 'telegram';
            $label = 'join';
        } else {
            $labelPlatform = 'twitter';

            if ($type == TWITTER_FOLLOW) {
                $label = 'follow';
            } elseif ($type == TWITTER_LIKE) {
                $label = 'like';
            } elseif ($type == TWITTER_RETWEET) {
                $label = 'retweet';
            } else {
                $label = 'tweet';
            }
        }

        return [
            'platform' => $labelPlatform,
            'type' => $label
        ];
    }
}
