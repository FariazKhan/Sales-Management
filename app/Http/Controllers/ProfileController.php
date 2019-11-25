<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

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

    public function showResetForm()
    {
        return view('profile.reset');
    }

    public function resetpwd(Request $request)
    {
       $this->validate($request, [
           'oldpwd' => 'required',
           'newpwd' => 'required|min:8',
           'confnewpwd' => 'required|min:8|same:newpwd'
       ], [
            'oldpwd.required' => 'This field is required.',
            'newpwd.required' => 'This field is required.',
            'newpwd.min' => 'Minimum 8 characters required.',
            'newpwd.invalid' => 'The password format is invalid.',
            'confnewpwd.required' => 'This field is required.',
            'confnewpwd.min' => 'Minimum 8 characters required.',
            'confnewpwd.same' => 'New passwords doesn\'t match.',
       ]);

        $id = Auth::user()->id;
        $value = User::find($id)->get()->first();
        if (!Hash::check($request->oldpwd, $value->password)) {
            $validator = Validator::make([], []); // Empty data and rules fields
            $validator->errors()->add('pwderr', 'Error: Your old password is incorrect.');
            throw new ValidationException($validator);
        }
        $value->password = Hash::make($request->confnewpwd);
        $value->password = Hash::make($request->confnewpwd);
        $value->save();
        return redirect(route('profile.index'))->with('edtsuccess', 'success');
    }

    public function destroy($id)
    {
        //
    }
}
