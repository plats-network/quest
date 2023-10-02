<?php

namespace App\Http\Controllers\FrontendQuest;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $body_class = '';
        $userQuest = Auth::guard('quest')->user();

        // return view('dashboard', compact('body_class'));
        return view('quest.index', compact('body_class'));
    }

    //me
    public function me()
    {
        $body_class = '';
        $questUser = Auth::guard('quest')->user();
        if ($questUser){
            dd($questUser);
        }


        // return view('dashboard', compact('body_class'));
        return view('quest.me', compact('body_class'));
    }

    /**
     * Privacy Policy Page.
     *
     * @return \Illuminate\Http\Response
     */
    public function privacy()
    {
        $body_class = '';

        return view('quest.privacy', compact('body_class'));
    }

    /**
     * Terms & Conditions Page.
     *
     * @return \Illuminate\Http\Response
     */
    public function terms()
    {
        $body_class = '';

        return view('quest.terms', compact('body_class'));
    }

    //wallet
    public function wallet()
    {
        $body_class = '';

        return view('frontend.wallet', compact('body_class'));
    }
}
