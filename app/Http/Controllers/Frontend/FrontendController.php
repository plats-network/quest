<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

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

        // return view('dashboard', compact('body_class'));
        return view('frontend.index', compact('body_class'));
    }

    /**
     * Privacy Policy Page.
     *
     * @return \Illuminate\Http\Response
     */
    public function privacy()
    {
        $body_class = '';

        return view('frontend.privacy', compact('body_class'));
    }

    /**
     * Terms & Conditions Page.
     *
     * @return \Illuminate\Http\Response
     */
    public function terms()
    {
        $body_class = '';

        return view('frontend.terms', compact('body_class'));
    }

    //wallet
    public function wallet()
    {
        $body_class = '';

        return view('frontend.wallet', compact('body_class'));
    }

    //sendMail
    public function sendMail()
    {
        $body_class = '';
        //
        //Send email
        $data = [
            'name' => 'Nguyen Van A',
            'email' => ''
        ];
        $status =  Mail::send('emails.test', $data, function ($message) {
            $message->to('dungpxvaix@gmail.com', 'Dungpx')
                ->subject('Test send email');
        });
        //Check send email
        dd($status);
        //return view('frontend.sendMail', compact('body_class'));
    }
}
