<?php

namespace App\Http\Controllers\FrontendQuest\Auth;

use App\Models\User;
use Illuminate\Http\Request;

class DiscordAuthController
{

    //state
    public $state;
    //base_url
    public $base_url = "https://discord.com";
    //access_token
    public $access_token;
    //user
    public $user;
    //$code
    public $code;

    //Init
    public function redirectToDiscord()
    {
        # Setting the base url for API requests
        $GLOBALS['base_url'] = "https://discord.com";

# Setting bot token for related requests
        $GLOBALS['bot_token'] = null;
    }

    //handleDiscordCallback
    public function handleDiscordCallback(Request $request)
    {
        $GLOBALS['base_url'] = "https://discord.com";
        $_SESSION['state'] = bin2hex(openssl_random_pseudo_bytes(12));
        $data = $request->all();
        //Check has error
        if (isset($data['error'])) {
            //Send flash login error message
            $request->session()->flash('error', 'Kết nối thất bại!');
            return redirect(route('quest.index'));
        }
        //Check has code
        $code = $data['code'];
        $this->code = $code;

        //Get user information - todo move to config
        $client_id = env('DISCORD_CLIENT_ID');
        $client_secret = env('DISCORD_CLIENT_SECRET');
        $redirect_url = env('DISCORD_REDIRECT_URI');
        $bot_token = env('DISCORD_BOT_TOKEN');
        $dataInit = $this->init($redirect_url, $client_id, $client_secret, $bot_token);
        $UserGet = $this->get_user();

        /** @var User $questUser */
        $userLogin = auth()->guard('quest')->user();

        //Has exits set discord id
        if ($userLogin->discord_id) {
            //Login user
            //Log login history
            //Save discord ID to user
            $userLogin->discord_id = $UserGet['user_id'];
            $userLogin->discord_username = $UserGet['username'];

            $userLogin->save();
            //Send flash login success message
            $request->session()->flash('success', 'Kết nối thành công!');

            return redirect(route('quest.users.profileEdit', ['id' => encode_id($userLogin->id)]));
        } else {
            //Save discord ID to user
            $userLogin->discord_id = $UserGet['user_id'];
            $userLogin->discord_username = $UserGet['username'];

            $userLogin->save();
            //Send flash login success message
            $request->session()->flash('success', 'Kết nối thành công!');

            return redirect(route('quest.users.profileEdit', ['id' => encode_id($userLogin->id)]));
        }
    }

    //disconnectDiscord
    public function disconnectDiscord(Request $request)
    {
        /** @var User $questUser */
        $userLogin = auth()->guard('quest')->user();
        //Has exits set discord id
        if ($userLogin->discord_id) {
            //Login user
            //Log login history
            //Save discord ID to user
            $userLogin->discord_id = null;
            $userLogin->discord_username = null;

            $userLogin->save();
            //Send flash login success message
            $request->session()->flash('success', 'Ngắt kết nối thành công!');

            return redirect(route('quest.users.profileEdit', ['id' => encode_id($userLogin->id)]));
        } else {
            //Send flash login success message
            $request->session()->flash('success', 'Ngắt kết nối thành công!');

            return redirect(route('quest.users.profileEdit', ['id' => encode_id($userLogin->id)]));
        }
    }

# A function to generate a random string to be used as state | (protection against CSRF)
    function gen_state()
    {
        $_SESSION['state'] = bin2hex(openssl_random_pseudo_bytes(12));
        return $_SESSION['state'];
    }

    # A function to initialize and store access token in SESSION to be used for other requests
    function init($redirect_url, $client_id, $client_secret, $bot_token = null)
    {
        if ($bot_token != null)
            $GLOBALS['bot_token'] = $bot_token;
        $code = $this->code;
        $state = $this->gen_state();
        # Check if $state == $_SESSION['state'] to verify if the login is legit | CHECK THE FUNCTION get_state($state) FOR MORE INFORMATION.
        $url = $GLOBALS['base_url'] . "/api/oauth2/token";
        $data = array(
            "client_id"     => $client_id,
            "client_secret" => $client_secret,
            "grant_type"    => "authorization_code",
            "code"          => $code,
            "redirect_uri"  => $redirect_url
        );
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        curl_close($curl);
        $results = json_decode($response, true);

        //$_SESSION['access_token'] = $results['access_token'];
        //access_token
        $this->access_token = $results['access_token'];

        return $results;
    }

# A function to get user information | (identify scope)
    function get_user($email = null)
    {
        $url = $GLOBALS['base_url'] . "/api/users/@me";
        $access_token = $this->access_token;
        $headers = array('Content-Type: application/x-www-form-urlencoded', 'Authorization: Bearer ' . $access_token);
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec($curl);
        curl_close($curl);
        $results = json_decode($response, true);
//        $_SESSION['user'] = $results;
//        $_SESSION['username'] = $results['username'];
//        $_SESSION['discrim'] = $results['discriminator'];
//        $_SESSION['user_id'] = $results['id'];
//        $_SESSION['user_avatar'] = $results['avatar'];

        $dataUser = [
            'username'    => $results['username'],
            'discrim'     => $results['discriminator'],
            'user_id'     => $results['id'],
            'user_avatar' => $results['avatar'],
        ];
        # Fetching email
        if ($email == True) {
            //$_SESSION['email'] = $results['email'];
            $dataUser['email'] = $results['email'];
        }

        return $dataUser;
    }

# A function to give roles to the user
# Note : The bot has to be a member of the server with MANAGE_ROLES permission.
#        The bot DOES NOT have to be online, just has to be a bot application and has to be a member of the server.
#        This is the basic function which requires few parameters. [ 1: Guild ID,  2: Role ID ]
    function give_role($guildid, $roleid)
    {
        $data = json_encode(array("roles" => array("$roleid")));
        $url = $GLOBALS['base_url'] . "/api/guilds/$guildid/members/" . $_SESSION['user_id'] . "/roles/$roleid";
        $headers = array('Content-Type: application/json', 'Authorization: Bot ' . $GLOBALS['bot_token']);
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        $response = curl_exec($curl);
        curl_close($curl);
        $results = json_decode($response, true);
        return $results;
    }

# A function to get user guilds | (guilds scope)
    function get_guilds()
    {
        $url = $GLOBALS['base_url'] . "/api/users/@me/guilds";
        $headers = array('Content-Type: application/x-www-form-urlencoded', 'Authorization: Bearer ' . $_SESSION['access_token']);
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec($curl);
        curl_close($curl);
        $results = json_decode($response, true);
        return $results;
    }

# A function to fetch information on a single guild | (requires bot token)
    function get_guild($id)
    {
        $url = $GLOBALS['base_url'] . "/api/guilds/$id";
        $headers = array('Content-Type: application/x-www-form-urlencoded', 'Authorization: Bot ' . $GLOBALS['bot_token']);
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec($curl);
        curl_close($curl);
        $results = json_decode($response, true);
        return $results;
    }

# A function to get user connections | (connections scope)
    function get_connections()
    {
        $url = $GLOBALS['base_url'] . "/api/users/@me/connections";
        $headers = array('Content-Type: application/x-www-form-urlencoded', 'Authorization: Bearer ' . $_SESSION['access_token']);
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec($curl);
        curl_close($curl);
        $results = json_decode($response, true);
        return $results;
    }

# Function to make user join a guild | (guilds.join scope)
# Note : The bot has to be a member of the server with CREATE_INSTANT_INVITE permission.
#        The bot DOES NOT have to be online, just has to be a bot application and has to be a member of the server.
#        This is the basic function with no parameters, you can build on this to give the user a nickname, mute, deafen or assign a role.
    function join_guild($guildid)
    {
        $data = json_encode(array("access_token" => $_SESSION['access_token']));
        $url = $GLOBALS['base_url'] . "/api/guilds/$guildid/members/" . $_SESSION['user_id'];
        $headers = array('Content-Type: application/json', 'Authorization: Bot ' . $GLOBALS['bot_token']);
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        $response = curl_exec($curl);
        curl_close($curl);
        $results = json_decode($response, true);
        return $results;
    }

# A function to verify if login is legit
    function check_state($state)
    {
        if ($state == $_SESSION['state']) {
            return true;
        } else {
            # The login is not valid, so you should probably redirect them back to home page
            return false;
        }
    }
}
