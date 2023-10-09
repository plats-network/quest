<?php

namespace App\Http\Controllers\FrontendQuest;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;

class FrontendController extends Controller
{
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
        if ($questUser){
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
            ->where('wallet_name', $wallet_name)
            ->first();
        if ($user){
            //login
            //Auth::guard('quest')->login($user);
            //return redirect()->route('quest.home');
        }else{
            //create new user
            $user = new User();
            $user->wallet_address = $wallet_address;
            $user->wallet_name = $wallet_name;

            $password = bcrypt($wallet_address . $wallet_name);

            $user->first_name = $wallet_name;
            $user->last_name = $wallet_name;
            $user->name = $wallet_name;
            $user->email = $wallet_address . $wallet_name. '@gmail.com';
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
        //wallet_name
        $wallet_name = $request->wallet_name;
        //Check user by wallet_address and wallet_name in db
        //If not exist then create new user
        //If exist then login
        //If login success then redirect to home page
        //If login fail then redirect to login page
        $user = User::where('wallet_address', $wallet_address)
            ->where('wallet_name', $wallet_name)
            ->first();
        $msg = 'Login fail';
        $status = 'fail';
        if ($user) {
            //login
            Auth::guard('quest')->login($user);
            $msg = 'Login success';
            $status = 'success';
        }
        //Json response
        $output = [
            'status' => $status,
            'message' => $msg,
            'data' => [
                'user' => $user
            ]
        ];

        return response()->json($output);
    }

    //getCampainInfor to show reward type. block chain network, total token, total person
    public function getCampainInfor(Request $request)
    {
        $body_class = '';
        $post_id = $request->post_id;
        //Get model post
        /* @var Post $post*/
        $post = Post::find($post_id);
        //Check $post exist
        if (!$post){
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
        //Json response
        $output = [
            'status' => 'success',
            'message' => 'Get campain infor success',
            'data' => [
                'campain_infor' => $campainInfor
            ]
        ];

        return response()->json($output);
    }
}
