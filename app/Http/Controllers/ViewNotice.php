<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notice;

class ViewNotice extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show($id)
    {
        $dat = Notice::find($id);
        return view('notice.view')->with(compact('dat'));
    }

}
