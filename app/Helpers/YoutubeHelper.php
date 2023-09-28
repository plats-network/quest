<?php

namespace App\Helpers;

use Madcoda\Youtube;

class YoutubeHelper
{
    /*
     * Check Url is youtube Url
     * */
    public static function isYoutubeUrl($url)
    {
        if (strpos($url, 'youtube') > 0) {
            return true;
        }

        return false;
    }

    /*
     * Get Youtube ID from Url
     * */
    public static function getYoutubeID($link)
    {
        $video_id = explode('?v=', $link); // For videos like http://www.youtube.com/watch?v=...
        if (empty($video_id[1])) {
            $video_id = explode('/v/', $link);
        } // For videos like http://www.youtube.com/watch/v/..

        if (isset($video_id) && isset($video_id[1])) {
            $video_id = explode('&', $video_id[1]); // Deleting any other params
            $video_id = $video_id[0];

            return $video_id;
        } else {
            return $link;
        }
    }

    /**
     * get youtube video ID from URL
     *
     * @param  string  $url
     * @return string Youtube video id or FALSE if none found.
     */
    public static function youtube_id_from_url($url)
    {
        $pattern =
            '%^# Match any youtube URL
        (?:https?://)?  # Optional scheme. Either http or https
        (?:www\.)?      # Optional www subdomain
        (?:             # Group host alternatives
          youtu\.be/    # Either youtu.be,
        | youtube\.com  # or youtube.com
          (?:           # Group path alternatives
            /embed/     # Either /embed/
          | /v/         # or /v/
          | /watch\?v=  # or /watch\?v=
          )             # End path alternatives.
        )               # End host alternatives.
        ([\w-]{10,12})  # Allow 10-12 for 11 char youtube id.
        $%x';
        $result = preg_match($pattern, $url, $matches);
        if ($result) {
            return $matches[1];
        }

        return false;
    }

    /*
     * Get youtube embed url
     * */
    public static function getEmbedUrl($url)
    {
        $baseEmbedUrl = 'https://www.youtube.com/embed/';

        return $baseEmbedUrl.YoutubeHelper::youtube_id_from_url($url);
    }

    /*
     * Get Video Info detail
     * */
    public static function getVideoDetail($vid)
    {
        $key = 'AIzaSyAbCn4H2gG4OfkIefnXWaShvS8QcEpkGZY';
        $youtube = new Youtube(['key' => $key]);
        $video = $youtube->getVideoInfo($vid);

        return $video;
    }

    /*
     * Kiểm tra ID được phép xem
     * */
    public static function getPublishStatus($vid)
    {
        $status = true;
        $vInfo = self::getVideoDetail($vid);
        if (isset($vInfo->contentDetails->regionRestriction)) {
            $status = false;
        }

        return $status;
    }
}
