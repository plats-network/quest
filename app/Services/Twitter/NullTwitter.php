<?php

namespace App\Services\Twitter;

class NullTwitter implements TwitterInterface
{
    public function tweet(string $text): ?array
    {
        return null;
    }
    //Follow
    public function following($userTweetId, $keyFollow)
    {
        return null;
    }
    //Like
    public function like($userTweetId, $keyLike)
    {
        return null;
    }
}
