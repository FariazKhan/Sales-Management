<?php

namespace App\Http\Controllers;

use App\Sales;
use App\Sold;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dat = Sold::all();
        return view('sales.show')->with(compact('dat'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = Sales::where("available", ">", 0)->get();
        return view('sales.create')->with(compact('data'));
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
            'name' => 'required',
            'quantity' => 'required'
        ]);

        $injector = new Sold;
        $injector->name = $request->name;
        $injector->quantity = $request->quantity;
        $editor = Sales::where('name', '=', $request->name)->get()->first();
        $available = $editor->available - $request->quantity;
        if ($request->quantity > $editor->available)
        {
            $validator = Validator::make([], []); // Empty data and rules fields
            $validator->errors()->add('quantityExceeded', 'The quantity is more than the available products!');
            throw new ValidationException($validator);
        }
        elseif ($request->quantity < 0)
        {
            $validator = Validator::make([], []);
            $validator->errors()->add('quantityInvalid', 'The product quantity is invalid!');
            throw new ValidationException($validator);
        }
        elseif ($editor->quantity == 0)
        {
            $validator = Validator::make([], []);
            $validator->errors()->add('oos', 'The product is currently out of stock!');
            throw new ValidationException($validator);
        }
        $editor->available = $available;
        $injector->save();
        $editor->save();

        return redirect(route('sales.index'))->with('inssuccess', 'success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Sold::find($id);
        return view('sales.edit')->with(compact('data'));
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
            'quantity' => 'required'
        ]);
        $updator = Sold::find($id);
        $updator->name = $request->name;
        $updator->quantity = $request->quantity;
        $updator->save();
        return redirect(route('sales.index'))->with('edtsuccess', 'success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Sold::find($id)->delete();
        return redirect(route('sales.index'))->with('dltsuccess', 'success');
    }
}
