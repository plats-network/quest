<?php

namespace App\Http\Controllers\FrontendQuest;

use App\Http\Controllers\Controller;
use App\Models\UserReward;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Facades\Schema;

class FrontendController extends Controller
{
    //updateDb
    public function updateDb(Request $request)
    {
        if ($request->input('key') == 1) {
            //Unknown column 'intro_text' in 'field list' (Connection: mysql, SQL: insert into infos (
            /*Schema::table('posts', function ($table) {
                $table->string('category_token')->nullable();
            });*/

            Schema::table('tasks', function ($table) {
                //$table->string('category_token')->nullable();
                $table->string('hash_tag')->nullable();
            });
        }
        if ($request->input('key') == 2) {
            //Unknown column 'intro_text' in 'field list' (Connection: mysql, SQL: insert into infos (
            /*Schema::table('posts', function ($table) {
                $table->string('category_token')->nullable();
            });*/

            Schema::table('posts', function ($table) {
                //Change total_token int to string
                $table->string('category_token')->nullable()->change();
            });
        }

        dd('Update card code successfully');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $body_class = '';
        $userQuest = Auth::guard('quest')->user();

        // return view('dashboard', compact('body_class'));
        return view('quest.index', compact('body_class'));
    }

    //me
    public function me(Request $request)
    {
        $body_class = '';
        $questUser = Auth::guard('quest')->user();
        if ($questUser) {
            dd($questUser);
        }

        // return view('dashboard', compact('body_class'));
        return view('quest.me', compact('body_class'));
    }

    //support
    public function support(Request $request)
    {
        $body_class = '';

        return view('quest.support', compact('body_class'));
    }

    /**
     * Privacy Policy Page.
     *
     * @return \Illuminate\Http\Response
     */
    public function privacy(Request $request)
    {
        $body_class = '';

        return view('quest.privacy', compact('body_class'));
    }

    /**
     * Terms & Conditions Page.
     *
     * @return \Illuminate\Http\Response
     */
    public function terms(Request $request)
    {
        $body_class = '';

        return view('quest.terms', compact('body_class'));
    }

    //wallet
    public function wallet(Request $request)
    {
        $body_class = '';

        return view('frontend.wallet', compact('body_class'));
    }

    /*
     * connectWallet
     * Sau khi connect xong thì frontend gửi lên backend 2 thông tin:
     * wallet_address và wallet_name (account name: optional)
Backend xử lý nếu chưa có trong DB thì đăng ký user mới.
    Nếu có rồi thì thôi. Cuối cùng xử lý để sao cho user đó đã ở trạng thái đã login.
     * */
    public function connectWallet(Request $request)
    {
        $body_class = '';
        //wallet_address
        $wallet_address = $request->wallet_address;
        //wallet_name
        $wallet_name = $request->wallet_name;
        //Check user by wallet_address and wallet_name in db
        //If not exist then create new user
        //If exist then login
        //If login success then redirect to home page
        //If login fail then redirect to login page
        $user = User::where('wallet_address', $wallet_address)
            //->where('wallet_name', $wallet_name)
            ->first();

        if ($user) {
            //login
            //Auth::guard('quest')->login($user);
            //return redirect()->route('quest.home');
        } else {
            //create new user
            $user = new User();
            $user->wallet_address = $wallet_address;
            $user->wallet_name = $wallet_name;

            $password = bcrypt($wallet_address . $wallet_name);

            $user->first_name = $wallet_name;
            $user->last_name = $wallet_name;
            $user->name = $wallet_name;
            $user->email = $wallet_address . $wallet_name . '@gmail.com';
            $user->password = $password;

            $user->save();
            //login
            //Auth::guard('quest')->login($user);
        }


        //Json output
        $output = [
            'status' => 'success',
            'message' => 'Connect wallet success',
            'data' => [
                'user' => $user
            ]
        ];

        return response()->json($output);

        //return view('frontend.connect-wallet', compact('body_class'));
    }

    //walletLogin
    public function walletLogin(Request $request)
    {
        $body_class = '';
        $wallet_address = $request->wallet_address;
        //Check $wallet_address
        if (!$wallet_address) {
            //Json response
            $output = [
                'status' => 'fail',
                'message' => 'Wallet address is required',
                'data' => [
                    'user' => null
                ]
            ];

            return response()->json($output);
        }
        //wallet_name
        $wallet_name = $request->wallet_name;
        //Check user by wallet_address and wallet_name in db
        //If not exist then create new user
        //If exist then login
        //If login success then redirect to home page
        //If login fail then redirect to login page
        $user = User::where('wallet_address', $wallet_address)
            //->where('wallet_name', $wallet_name)
            ->first();

        //Check !user
        if ($user == false){
            //Json response
            $output = [
                'status' => 'fail',
                'message' => 'Login fail',
                'data' => [
                    'user' => null
                ]
            ];

            return response()->json($output);
        }

        $msg = 'Login fail';
        $status = 'fail';
        if ($user) {
            //login
            Auth::guard('quest')->login($user);
            $msg = 'Login success';
            $status = 'success';

            return  redirect()->route('quest.home');
        }
        //Json response
        $output = [
            'status' => $status,
            'message' => $msg,
            'data' => [
                'user' => $user
            ]
        ];

        return redirect()->route('quest.home');
    }

    //getCampainInfor to show reward type. block chain network, total token, total person
    public function getCampainInfor(Request $request)
    {
        $body_class = '';
        $post_id = $request->post_id;
        //Get model post
        /* @var Post $post */
        $post = Post::find($post_id);
        //Check $post exist
        if (!$post) {
            //Json response
            $output = [
                'status' => 'fail',
                'message' => 'Post not exist',
                'data' => [
                    'campain_infor' => null
                ]
            ];

            return response()->json($output);
        }
        //Get campain infor
        $campainInfor = [
            'reward_type' => $post->reward_type,
            'block_chain_network' => $post->block_chain_network,
            'total_token' => $post->total_token,
            'total_person' => $post->total_person,
        ];
        //List User Reward
        $listUserReward = [];
        foreach ($post->userRewards as $userReward) {
            $listUserReward[] = [
                'id' => $userReward->id,
                'user_id' => $userReward->user_id,
                'user_name' => $userReward->user->name,
                'user_wallet_address' => $userReward->user->wallet_address,
                'user_wallet_name' => $userReward->user->wallet_name,
                'reward_type' => $userReward->reward_type,
                'block_chain_network' => $userReward->block_chain_network,
                'total_token' => $userReward->total_token,
                'created_at' => $userReward->created_at->format('Y-m-d H:i:s'),
            ];
        }
        //Json response
        $output = [
            'status' => 'success',
            'message' => 'Get campain infor success',
            'data' => [
                'campain_infor' => $campainInfor,
                'list_user_reward' => $listUserReward
            ]
        ];

        return response()->json($output);
    }

    //updateUserRewardStatus api
    public function updateUserRewardStatus(Request $request)
    {
        $id = $request->id;
        $status = $request->status;
        //Get reward
        /*@var UserReward $userReward*/
        $userReward = UserReward::find($id);
        if (!$userReward) {
            //Json response
            $output = [
                'status' => 'fail',
                'message' => 'Reward not exist',
                'data' => [
                    'user_reward' => null
                ]
            ];

            return response()->json($output);
        }
        //Update status
        $userReward->status = $status;

        $userReward->save();
        //Json response
        $output = [
            'status' => 'success',
            'message' => 'Update user reward status success',
            'data' => [
                'user_reward' => $userReward
            ]
        ];

        return response()->json($output);

    }

    //updateQuestDepositStatus
    public function updateQuestDepositStatus(Request $request)
    {
        $id = $request->id;
        $status = $request->status;
        //Total token
        $total_token = $request->total_token;
        //Get reward

        /*@var Post $quest*/
        $quest = Post::find($id);

        if (!$quest) {
            //Json response
            $output = [
                'status' => 'fail',
                'message' => 'Quest not exist',
                'data' => [
                    'user_reward' => null
                ]
            ];

            return response()->json($output);
        }
        //Update status
        $quest->deposit_status = $status;
        $quest->total_token = $total_token;

        $quest->save();
        //Json response
        $output = [
            'status' => 'success',
            'message' => 'Update quest deposit status success',
            'data' => [
                'user_reward' => $quest
            ]
        ];

        return response()->json($output);

    }

    public function updatePostTotalToken(Request $request)
    {
        $id = $request->id;
        //Total token
        $total_token = $request->total_token;
        //Network
        $network = $request->block_chain_network;
        //Get reward

        /* @var Post $quest */
        $quest = Post::query()
            ->where('id', $id)
            ->first();

        if (!$quest) {
            //Json response
            $output = [
                'status' => 'fail',
                'message' => 'Quest not exist',
                'data' => [
                    'user_reward' => null
                ]
            ];

            return response()->json($output);
        }
        //Update status
        $quest->block_chain_network = $network;
        $quest->total_token = $total_token;

        $quest->save();
        //Json response
        $output = [
            'status' => 'success',
            'message' => 'Update quest  success',
            'data' => [
                'block_chain_network' => $network,
                'total_token' => $total_token,
            ]
        ];

        return response()->json($output);

    }

}
