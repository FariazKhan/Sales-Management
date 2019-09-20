<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notice;

class ManageNotice extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verifyRoles', ['except' => 'viewNotice']);
        $this->middleware('verifyAdmin', ['except' => 'viewNotice']);
        $this->middleware('getRoles');

    }

    public function index()
    {
        $dat = Notice::all();
        return view('notice.show')->with(compact('dat'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('notice.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'expdate' => 'required'
            ],
            [
                'expdate.required' => 'The expiry date field cannot be empty.'
        ]);

        $injector = new Notice;
        $injector->title = $request->title;
        $injector->body = $request->body;
        $indate =  strtotime($request->expdate);
        $injector->expdate = date("Y-m-d H:i:s",$indate);
        $injector->save();
        return redirect(route('notice.index'))->with('insertion', 'success');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dat = Notice::find($id);
        return view('notice.view')->with(compact('dat'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dat = Notice::find($id);
        return view('notice.edit')->with(compact('dat'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'expdate' => 'required'
        ],
            [
                'expdate.required' => 'The expiry date field cannot be empty.'
            ]);

        $injector = Notice::find($id);
        $injector->title = $request->title;
        $injector->body = $request->body;
        $indate =  strtotime($request->expdate);
        $injector->expdate = date("Y-m-d H:i:s",$indate);
        $injector->save();
        return redirect(route('notice.index'))->with('edt', 'success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
