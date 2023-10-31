<?php

namespace App\Services\Twitter;

interface TwitterInterface
{
    public function tweet(string $text): ?array;

   /* //deleteTweet
    public function deleteTweet($tweetId);

    //Follow
    public function following($userTweetId, $keyFollow);

    //Like
    public function like($userTweetId, $keyLike);*/
}
