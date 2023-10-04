<?php

namespace App\Services\Concerns;

use App\Services\Traits\MessageTraitService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\{Auth, Http};

abstract class BaseTwitter
{
    use MessageTraitService;
    use AuthorizesRequests;

    /**
     * @return object | null
     */
    public function callApi($uri, $method = 'GET', $params = [])
    {
        switch($method) {
            case "GET":
            case "get":
                $res = Http::withToken($this->getToken())
                    ->get(config('app.twitter_api_url') . $uri);
                break;
            case "POST":
            case "post":
                $res = Http::withToken($this->getToken())
                    ->post(config('app.twitter_api_url') . $uri, $params);
                break;
            default:
                $res = null;
        }

        return $res;
    }

    /**
     * @return string | null
     */
    private function getToken()
    {
        return config('app.twitter_token');
    }
}
