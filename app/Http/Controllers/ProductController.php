<?php

namespace App\Http\Controllers;

use App\Sales;
use Illuminate\Http\Request;

class ProductController extends Controller
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
        $dat = Sales::all();
        return view('product.show')->with(compact('dat'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product.create');
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
            'name' => 'required|unique:sales',
            'price' => 'required|numeric',
            'quantity' => 'required'
        ], [
            'price.numeric' => 'Please fill this field with numeric values only.'
        ]);

        $injector = new Sales;
        $injector->name = $request->name;
        $injector->quantity = $request->quantity;
        $injector->price = $request->price;
        $injector->available = $request->quantity;
        $injector->save();

        return redirect(route('product.index'))->with('inssuccess', 'success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dat = Sales::find($id);
        return view('product.view')->with(compact('dat'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Sales::find($id);
        return view('product.edit')->with(compact('data'));
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
            'quantity' => 'required',
            'price' => 'required|numeric',
            'available' => 'required'
        ]);
        $updator = Sales::find($id);
        $updator->name = $request->name;
        $updator->quantity = $request->quantity;
        $updator->price = $request->price;
        $updator->available = $request->available;
        $updator->save();
        return redirect(route('product.index'))->with('edtsuccess', 'success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Sales::find($id)->delete();
        return redirect(route('product.index'))->with('dltsuccess', 'success');
    }
}
