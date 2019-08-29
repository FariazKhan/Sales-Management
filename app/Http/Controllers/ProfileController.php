<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('getRoles');

    }

    public function index()
    {
        $name = Auth::user()->name;
        $data = User::where('name', '=', $name)->get()->first();
//        return $data;
        return view('profile.show')->with(compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
            'name' => 'required',
            'email' => 'required',
        ]);
        $value = User::find($id - 53995);
        if ($request->image) {
            @unlink('user/uploads/avatar'.$value->image);
            $originalImage = $request->image;
            $extension = $originalImage->getClientOriginalExtension();
            $filename = uniqid().'.'.$extension;
            $originalImage->move(public_path('user/uploads/avatar'), $filename);
            $value->image = $filename;
        }
        $value->name = $request->name;
        $value->email = $request->email;
        if ($request->pwd && $request->newpwd && $request->confnewpwd)
        {
            if  (Hash::check($request->oldpwd, $value->password) && $request->newpwd == $request->confnewpwd)
            {
                $newpwd = Hash::make($request->confnewpwd);
                $value->password = $newpwd;
            }
            else
            {
                return back()->with('edtfailed', 'failed');
            }
        }
        $value->save();
        return back()->with('edtsuccess', 'success');
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
