<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\FetchRoles;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class ManageUsers extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verifyRoles');
        $this->middleware('verifyAdmin');
        $this->middleware('getRoles');

    }

    public function index()
    {
        $dat = User::all();
        return view('users.show')->with(compact('dat'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dat = FetchRoles::all();
        return view("users.create")->with(compact('dat'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $val = User::all();
        foreach ($val as $value)
        {
            if ( strcmp($value->name ,$request->name) === 0 || strcmp($value->email, $request->email) === 0)
            {
                $validator = Validator::make([], []); // Empty data and rules fields
                $validator->errors()->add('sameValue', 'Error: An user with same name or email already exists.');
                throw new ValidationException($validator);
            }
        }

        if (strcmp($request->password, $request->confpwd))
        {
            $validator = Validator::make([], []); // Empty data and rules fields
            $validator->errors()->add('wrongPwd', 'Error: The passwords do not match.');
            throw new ValidationException($validator);
        }

        if (strlen($request->password) < 8 || strlen($request->confpwd) < 8)
        {
            $validator = Validator::make([], []); // Empty data and rules fields
            $validator->errors()->add('lowPwd', 'Error: The password must be at least 8 characters.');
            throw new ValidationException($validator);
        }

        $inject = new User;
        $inject->name = $request->name;
        $inject->email = $request->email;
        $inject->image = 'user_default.png';
        $inject->role = $request->role;
        $inject->password = Hash::make($request->password);
        $inject->save();
        return redirect(route('users.index'))->with('inssuccess', 'success');

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
        $val = User::find($id);
        $num = User::where('role' ,'=', '1')->count();
        if ($num <= 1 && strcmp($val->role, 1) == 0 )
        {
            $dat = null;
            return view('users.edit')->with(compact('val', 'dat'));
        }
        else
        {
            $dat = FetchRoles::all();
            return view('users.edit')->with(compact('val', 'dat'));
        }
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
        $dat = User::where('role', '=', '1')->count();
        $val = User::all();
        $inject = User::find($id);

        if (isset($request->password) && isset($request->confpwd))
        {
            if (strcmp($request->password, $request->confpwd))
            {
                $validator = Validator::make([], []); // Empty data and rules fields
                $validator->errors()->add('wrongPwd', 'Error: The passwords do not match.');
                throw new ValidationException($validator);
            }

            if (strlen($request->password) < 8 || strlen($request->confpwd) < 8)
            {
                $validator = Validator::make([], []); // Empty data and rules fields
                $validator->errors()->add('lowPwd', 'Error: The password must be at least 8 characters.');
                throw new ValidationException($validator);
            }

            if (strcmp($request->password, '') == 0 || strcmp($request->password, ' ') == 0 || strcmp($request->confpwd, '') == 0 || strcmp($request->confpwd, ' ') == 0 )
            {
                $validator = Validator::make([], []); // Empty data and rules fields
                $validator->errors()->add('invalidpwd', 'Error: The password is invalid.');
                throw new ValidationException($validator);
            }
            $inject->password = Hash::make($request->password);
        }
        if ($request->role == null && $dat > 1)
        {
            $validator = Validator::make([], []); // Empty data and rules fields
            $validator->errors()->add('lowPwd', 'Error: No role selected for the user.');
            throw new ValidationException($validator);
        }
        $inject->name = $request->name;
        $inject->email = $request->email;
        if ($dat <= 1 && $request->role === null)
        {
            $inject->role = $inject->role;
        }
        else
        {
            $inject->role = $request->role;
        }
        $inject->save();
        return redirect(route('users.index'))->with('updtsuccess', 'success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dat = User::where('role', '=', '1')->count();
        if ($dat <= 1)
        {
           return back()->with('onlyadminacc', 'failed');
        }
        else
        {
            User::find($id)->delete();
            return redirect(route('users.index'))->with('dltsuccess', 'success');
        }
    }
}
