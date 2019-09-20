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
            'image' => 'image|max:5120',
        ], [
            'image.image' => 'The image you have uploaded is invalid.',
            'image.max' => 'The image size must be less than 5 MegaBytes.',
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
        $value->password = Hash::make($request->confnewpwd);
        $value->save();
        return back()->with('edtsuccess', 'success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function showResetForm()
    {
        return view('profile.reset');
    }
    public function resetpwd(Request $request)
    {
//        $this->validate($request, [
//            'oldpwd' => 'required',
//            'newpwd' => 'required|min:8',
//            'confnewpwd' => 'required|same:newpwd'
//        ], [
//            'oldpwd.required' => 'This field is required.',
//            'newpwd.required' => 'This field is required.',
//            'newpwd.invalid' => 'The password format is invalid.',
//            'confnewpwd.required' => 'This field is required.',
//            'confnewpwd.same' => 'The passwords doesn\'t match.',
//        ]);
//
//
//        if (!(Hash::check($request->oldpwd, Auth::user()->password))) {
//            // The passwords matches
//            return back()->with("edtfailed", "Your current password does not matches with the password you provided. Please try again.");
//        }
//        if(strcmp($request->newpwd, $request->confnewpwd) !== 0){
//            //Current password and new password are same
//            return back()->with("edtfailed", "New Password cannot be same as your current password. Please choose a different password.");
//        }
        $id = Auth::user()->id;
        $value = User::find($id)->get()->first();
        $value->password = Hash::make($request->confnewpwd);
        $value->save();
        return redirect(route('profile.index'))->with('edtsuccess', 'success');
    }

    public function destroy($id)
    {
        //
    }
}
