<?php

namespace App\Http\Controllers\FrontendQuest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function index() {
        $msg = "This is a simple message.";
        return response()->json(array('msg'=> $msg), 200);
    }

    public function store(Request $request)
    {
        $grocery = new Grocery();
        $grocery->name = $request->name;
        $grocery->type = $request->type;
        $grocery->price = $request->price;

        $grocery->save();
        return response()->json(['success'=>'Data is successfully added']);
    }
}
