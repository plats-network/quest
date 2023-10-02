<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccessToken extends Model
{
    use HasFactory;

    //Twiter Generate Consumer Keys and Authentication Tokens;
    /*
     * API key <API key> e.g.xvz1evFS4wEEPTGEFPHBog
API secret key <API secret key> e.g. L8qq9PZyRg6ieKGEKhZolGC0vJWLw8iEJ88DRdyOg
curl -u "$API_KEY:$API_SECRET_KEY" \
  --data 'grant_type=client_credentials' \
  'https://api.twitter.com/oauth2/token'
     * */

    //Generate Twitter Bearer Token Token
    //curl -u 'API key:API secret key' --data 'grant_type=client_credentials' 'https://api.twitter.com/oauth2/token'

    public static function generateTwitterBearerToken()
    {
        //API key
        $API_KEY = env('TWITTER_CLIENT_ID');
        //API secret key
        $API_SECRET_KEY= env('TWITTER_CLIENT_SECRET');

        $url = 'https://api.twitter.com/oauth2/token';

        //Call Curl
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_USERPWD, $API_KEY . ':' . $API_SECRET_KEY);
        curl_setopt($ch, CURLOPT_POSTFIELDS, 'grant_type=client_credentials');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded;charset=UTF-8'));
        $result = curl_exec($ch);
        curl_close($ch);
        $json = json_decode($result);

        return $json->access_token;
    }

    public static function generateToken($user_id)
    {
        $token = md5(uniqid(rand(), true));
        $access_token = new AccessToken();
        $access_token->access_token = $token;
        $access_token->user_id = $user_id;
        $access_token->save();
        return $token;
    }
}
